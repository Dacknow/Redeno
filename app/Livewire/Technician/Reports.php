<?php

namespace App\Livewire\Technician;

use App\Models\Report;
use App\Models\Technician;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Subdomain;
use App\Models\DataNoveltyType;
use App\Models\ReportItem;
use App\Models\Admin;
use App\Models\Image;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads; // Importante para manejar archivos en Livewire
use Illuminate\Support\Facades\Storage;

class Reports extends Component
{
    use WithFileUploads; // Importante para manejar archivos en Livewire

    public $photos = []; // Almacena las imágenes temporalmente
    public $technician;
    public $selected_day;
    public $report_types;
    public $reportTypeSelected;
    public $selectedReport;
    public $adminSelected;
    public $description;
    public $data = [];
    public $form = [];
    public $reports;
    public $admins;
    public $reportToDelete;

    public function updatedReportTypeSelected($value)
    {
        $this->dispatch('$refresh'); // Actualiza el componente Livewire
    }
    public function updatedSelectedDay($value){
        $this->dispatch('$refresh');
        
    }

    public function mount()
    {
        $this->technician = Technician::findOrFail(auth('technician')->id());
        $this->selected_day = now()->format('Y-m-d'); // Fecha actual por defecto
        $this->report_types = Subdomain::where('domain_id', getDomainId('report_type'))->get();
    }

    public function viewReport($reportId)
    {
        $this->selectedReport = Report::with(['technician', 'manager', 'state', 'items.item'])
            ->findOrFail($reportId);

        $this->dispatch('show-modal-report-detail');
    }

    public function createReport()
    {
        $this->dispatch('show-modal-create-report');
    }

    public function storeReport()
    {
        $this->validate([
            'reportTypeSelected' => 'required|exists:subdomains,id',
            'adminSelected' => 'required|exists:admins,id',            
            'photos.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // Solo imágenes
        ], [
            'reportTypeSelected.required' => 'El tipo de reporte es obligatorio.',
            'reportTypeSelected.exists' => 'El tipo de reporte seleccionado no existe.',
            'adminSelected.required' => 'El administrador es obligatorio.',
            'adminSelected.exists' => 'El administrador seleccionado no existe.',
            'photos.*.image' => 'El archivo debe ser una imagen.',
            'photos.*.mimes' => 'El archivo debe ser una imagen (JPG, JPEG, PNG, GIF).',
            'photos.*.max' => 'La imagen no puede exceder los 2MB.',
        ]);

        DB::beginTransaction();

        try {
            // Obtener el estado "Pendiente"
            $stateId = Subdomain::where('subdomain', 'Pendiente')
                ->whereHas('parent', function ($query) {
                    $query->where('subdomain', 'reports');
                })
                ->value('id');

            // Crear el reporte
            $report = Report::create([
                'novelty_type_id' => $this->reportTypeSelected,
                'manager_id' => $this->adminSelected,
                'technician_id' => auth('technician')->id(),
                'description' => $this->description,
                'state_id' => $stateId,
            ]);

            // Guardar items del formulario
            if (!empty($this->form)) {
                $reportItems = [];
                $now = Carbon::now();

                foreach ($this->form as $data_id => $value) {
                    $reportItems[] = [
                        'report_id' => $report->id,
                        'item_id' => $data_id,
                        'value' => $value,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                ReportItem::insert($reportItems); // Inserción masiva optimizada
            }

            

            // Guardar imágenes
            foreach ($this->photos as $photo) {
                $path = 'images/reports/';
                $filename = 'image_report_technician_' . uniqid() . '.' . $photo->extension();

                // Almacenar la imagen en el disco 'public'
                $photoPath = $photo->storeAs($path, $filename, 'public');

                Image::create([
                    'report_id' => $report->id,
                    'image_url' => $photoPath, // Guardamos solo la ruta relativa
                    'author' => 'technician', // 
                ]);
            }

            DB::commit();

            // Resetear formulario
            $this->reset(['reportTypeSelected', 'adminSelected', 'form', 'description', 'photos']);

            // Cerrar modal y mostrar mensaje de éxito
            $this->dispatch('hide-modal');
            $this->dispatch('success', '¡Reporte creado exitosamente!');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error', 'Error al crear el reporte: ' . $e->getMessage());
        }
    }

    public function getStateColor($state)
    {
        return match ($state) {
            'Pendiente' => 'btn-outline-danger',
            'En Gestión' => 'btn-outline-warning',
            'Gestionado' => 'btn-outline-success',
            'Escalado' => 'btn-outline-primary',
            'Rechazado' => 'btn-outline-dark',
            default => 'btn-outline-secondary',
        };
    }

    // funcion para confirmar la eliminacion de un reporte
    public function deleteReportConfirm($reportId)
    {
        $this->reportToDelete = Report::findOrFail($reportId);
        $this->dispatch('show-delete-report-modal');
    }

    public function deleteReport()
    {
        $this->reportToDelete->delete();
        $this->dispatch('hide-modal');
        $this->dispatch('success', '!Reporte eliminado exitosamente!');
    }

    public function render()
    {
        // Usar carga diferida para evitar consultas innecesarias
        $this->reports = $this->technician->reports()
            ->whereDate('created_at', $this->selected_day)
            ->get();

        $this->data = DataNoveltyType::where('novelty_type_id', $this->reportTypeSelected)->get();
        
        $this->admins = Admin::whereHas('roles', function ($query) {
            $query->whereHas('reportTypeRoles', function ($subQuery) {
                $subQuery->where('novelty_type_id', $this->reportTypeSelected);
            });
        })->get();

        return view('livewire.technician.reports');
    }
}


