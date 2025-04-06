<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Report;
use App\Models\Admin;
use App\Models\Image;
use App\Models\Subdomain;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads; // Importante para manejar archivos en Livewire
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class ManageReports extends Component
{
    use WithFileUploads; // Importante para manejar archivos en Livewire

    public $admin;
    public $selected_day;
    public $selectedReport;
    public $description;
    public $reports;
    public $states;
    public $reportStateSelected;
    public $adminResponse;

    
    public function updatedSelectedDay($value){
        $this->dispatch('$refresh');
        
    }

    public function mount()
    {
        $this->admin = Admin::findOrFail(auth('admin')->id());
        $this->selected_day = now()->format('Y-m-d'); // Fecha actual por defecto
        $this->states = Subdomain::where('domain_id', getDomainId('states'))
                                ->where('parent_id', getSubdomainId('reports'))->get();;
        
    }

    public function viewReport($reportId)
    {
        $this->selectedReport = Report::with(['technician', 'manager', 'state', 'items.item'])
            ->findOrFail($reportId);
            

        $this->dispatch('show-modal-report-detail');
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

    public function changeState($reportId){
        $this->selectedReport = Report::findOrFail($reportId);
        $stateP = getSubdomainId('Pendiente');
        $stateG = getSubdomainId('En Gestión');
        $stateE = getSubdomainId('Escalado');

        if($this->selectedReport->state_id == $stateP){
            $newState = getSubdomainId('En Gestión');
            $this->selectedReport->state_id = $newState;
            
            $this->selectedReport->save();
            $this->selectedReport = null;
            $this->dispatch('success', '!Cambio de estado a En Gestión!');
        }elseif($this->selectedReport->state_id == $stateG || $this->selectedReport->state_id == $stateE){
            
            $this->dispatch('show-modal-report-response');
        }

        
    }

    public function sendResponse(){
        {
            
            $this->validate([
                'adminResponse' => 'required|string|min:3',
                'reportStateSelected' => 'required|exists:subdomains,id',
            ],[
                'adminResponse.required' => 'La respuesta es requerida.',
                'adminResponse.string' => 'La respuesta debe ser una cadena de texto.',
                'adminResponse.min' => 'La respuesta debe tener al menos 3 caracteres.',
                'reportStateSelected.required' => 'El estado del reporte es requerido.',
                'reportStateSelected.exists' => 'El estado del reporte seleccionado no existe.',
 
            ]);
        
            
            if (!$this->selectedReport) {
                $this->dispatch('error', 'No se encontró el reporte.');
                return;
            }
        
            $report = Report::findOrFail($this->selectedReport->id);

            $state = Subdomain::findOrFail($this->reportStateSelected);
            if($state->subdomain == 'Escalado'){
                $admin = Admin::role('Coordinador')->first();
                $this->adminResponse = $this->adminResponse.' ¡¡¡ Escalado por '.$report->manager->name.' !!!';
                $report->manager_id = $admin->id;                
            }
        
            $report->admin_response = $this->adminResponse;
            $report->state_id = $this->reportStateSelected;
            $report->completation_time = Carbon::now();
            $report->save();
            
            $this->dispatch('$refresh'); // Actualizar la lista de reportes

        
            // Limpiar los datos del formulario
            $this->adminResponse = '';
            $this->reportStateSelected = null;
            $this->selectedReport = null;
        
            // Cerrar el modal
            $this->dispatch('hide-modal');
            $this->dispatch('success', '¡Respuesta guardada exitosamente!');
        }
    }


    public function render()
    {        
        // Usar carga diferida para evitar consultas innecesarias
        $this->reports = $this->admin->reports()
            ->with(['state', 'noveltyType']) // para evitar múltiples consultas
            ->whereDate('created_at', $this->selected_day)
            ->get();

        return view('livewire.admin.manage-reports');
    }
}
