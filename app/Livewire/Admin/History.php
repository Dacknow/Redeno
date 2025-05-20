<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Report;
use App\Models\Subdomain;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class History extends Component
{
    use WithPagination;

    public $searchByDay, $searchByReport, $searchByAdmin, $searchByTechnician;
    public $selectedReport, $stateSelected;
    public $states;

    protected $paginationTheme = "bootstrap";

    public function updatingSearchByDay()
    {
        $this->resetPage();
    }

    public function updatingSearchByReport()
    {
        $this->resetPage();
    }

    public function updatingSearchByAdmin()
    {
        $this->resetPage();
    }

    public function updatingSearchByTechnician()
    {
        $this->resetPage();
    }

    public function updatingStateSelected()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->states = Subdomain::where('domain_id', getDomainId('states'))
                                ->where('parent_id', getSubdomainId('reports'))
                                ->get();
    }

    public function getStateColor($state)
    {
        return match ($state) {
            'Pendiente' => 'btn-danger',
            'En Gestión' => 'btn-warning',
            'Gestionado' => 'btn-success',
            'Escalado' => 'btn-primary',
            'Rechazado' => 'btn-dark',
            default => 'btn-secondary',
        };
    }

    public function viewReport($reportId)
    {
        $this->selectedReport = Report::with(['technician', 'manager', 'state', 'items.item', 'images', 'histories.admin'])
                                    ->findOrFail($reportId);            

        $this->dispatch('show-modal-report-detail');
    }
    public function render()
    {
        $query = Report::query();

        // Filtro por fecha
        if ($this->searchByDay) {
            $query->whereDate('created_at', $this->searchByDay);
        }

        // Filtro por ID del reporte
        if ($this->searchByReport) {
            $query->where('id', $this->searchByReport);
        }

        // Filtro por nombre del administrador
        if ($this->searchByAdmin) {
            $query->whereHas('manager', function ($q) {
                $q->where('name', 'like', '%' . $this->searchByAdmin . '%');
            });
        }

        // Filtro por nombre del técnico
        if ($this->searchByTechnician) {
            $query->whereHas('technician', function ($q) {
                $q->where('name', 'like', '%' . $this->searchByTechnician . '%');
            });
        }

        // Filtro por estado
        if ($this->stateSelected) {
            $query->where('state_id', $this->stateSelected);
        }

        $reports = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.admin.history', [
            'reports' => $reports
        ]);
    }
}
