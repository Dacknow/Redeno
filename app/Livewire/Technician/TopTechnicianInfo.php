<?php

namespace App\Livewire\Technician;

use Livewire\Component;
use App\Models\Technician;

class TopTechnicianInfo extends Component
{
    public $technician;
    protected $listeners =[
        'updateTechnicianHeaderInfo' => '$refresh'  
    ];

    public function mount(){
        $this->technician = Technician::findOrFail(auth('technician')->id());
    }
    public function render()
    {
        return view('livewire.technician.top-technician-info');
    }
}
