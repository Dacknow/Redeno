<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;

class TopAdminInfo extends Component
{
    public $admin;
    protected $listeners =[
        'updateAdminHeaderInfo' => '$refresh'  
    ];

    public function mount(){
        $this->admin = Admin::findOrFail(auth('admin')->id());
    }
    public function render()
    {
        return view('livewire.admin.top-admin-info');
    }
}
