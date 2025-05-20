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
use App\Models\HistoryReport;

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

    protected function resetForm()
    {
        $this->adminResponse = '';
        $this->reportStateSelected = null;
        $this->selectedReport = null;
    }

    protected function resetSelectedReport()
    {
        $this->selectedReport = null;
    }


    public function changeState($reportId)
    {
        $report = Report::findOrFail($reportId);
        $pending = getSubdomainId('Pendiente');
        $inProgress = getSubdomainId('En Gestión');
        $escalated = getSubdomainId('Escalado');

        if ($report->state_id === $pending) {
            $report->update(['state_id' => $inProgress]);

            // Registrar acción del administrador
            HistoryReport::logAction(
                $report->id,
                $this->admin->id,
                'Cambió estado a En Gestión'
            );

            $this->dispatch('success', '!Cambió de estado a En Gestión!');
            $this->resetSelectedReport();
        } elseif (in_array($report->state_id, [$inProgress, $escalated])) {
            $this->selectedReport = $report;
            $this->dispatch('show-modal-report-response');
        }
    }

    
    public function sendResponse()
    {
        $this->validate([
            'adminResponse' => 'required|string|min:3',
            'reportStateSelected' => 'required|exists:subdomains,id',
        ], [
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
    
        if ($state->subdomain === 'Escalado') {
            $coordinator = Admin::role('Coordinador')->first();
            $this->adminResponse .= ' ¡¡¡ Escalado por ' . optional($report->manager)->name . ' !!!';
            $report->manager_id = optional($coordinator)->id;
        }
    
        $report->update([
            'admin_response' => $this->adminResponse,
            'state_id' => $this->reportStateSelected,
            'completation_time' => now(),
        ]);

            // Registrar historial
        $action = "Respuesta enviada: '{$this->adminResponse}' - Estado actualizado a '{$state->subdomain}'";
        HistoryReport::logAction($report->id, $this->admin->id, $action);
    
        $this->dispatch('$refresh'); // Actualizar la lista de reportes
        $this->resetForm();
        $this->dispatch('hide-modal');
        $this->dispatch('success', '¡Respuesta guardada exitosamente!');
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
