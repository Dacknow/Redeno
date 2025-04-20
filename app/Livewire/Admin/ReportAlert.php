<?php


namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportAlert extends Component
{
    public $reportCount = 0;
    public $previousCount = 0;
    public $isMuted = true;

    public function mount()
    {
        $this->isMuted = session()->get('isMuted', true); // default: muteado
        $this->previousCount = session()->get('previousReportCount', 0);
    }


    public function toggleMute()
    {
        $this->isMuted = !$this->isMuted;
        session()->put('isMuted', $this->isMuted);
    }

    public function render()
    {
        $admin = Auth::guard('admin')->user();
        $today = now()->format('Y-m-d');

        if ($admin) {
            $newCount = Report::where('manager_id', $admin->id)
                ->whereIn('state_id', [
                    getSubdomainId('Pendiente'),
                    getSubdomainId('Escalado')
                ])
                ->whereDate('created_at', $today)
                ->count();

            // Verificar si aumentó y no está muteado
            if ($newCount > $this->previousCount && !$this->isMuted) {
                
                $this->dispatch('play-notification');
            }

            // Guardar y actualizar estado
            $this->reportCount = $newCount;
            $this->previousCount = $newCount;
            session()->put('previousReportCount', $newCount);
        }

        return view('livewire.admin.report-alert');
    }
}

