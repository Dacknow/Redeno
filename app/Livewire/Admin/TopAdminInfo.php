<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;
use Livewire\Attributes\On;

class TopAdminInfo extends Component
{
    public $admin;

    #[On('updateAdminHeaderInfo')]
    public function mount(){
        $this->admin = Admin::findOrFail(auth('admin')->id());
    }
    public function render()
    {
        return view('livewire.admin.top-admin-info');
    }
}
