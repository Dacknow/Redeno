<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Technician;
use Livewire\WithPagination; // para paginar los usuarios

class Users extends Component
{
    use WithPagination; // para paginar los usuarios 

    public $searchAdmin;
    public $searchTechnician;
    public $tab = null;
    public $tabname = 'admins';
    protected $queryString = ['tab'=>['keep'=>true]];
    protected $paginationTheme="bootstrap"; // para usar los estilos de bootstrap para la paginacion

    

    public function updatingSearch(){
        $this->resetPage();
    }

    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;
    }

    public function render()
    {
        $admins = Admin::where('name', 'like', '%'.$this->searchAdmin.'%' )
                    ->orWhere('email', 'like', '%'.$this->searchAdmin.'%')->paginate(10);

        $technicians = Technician::where('name', 'like', '%'.$this->searchTechnician.'%' )
                    ->orWhere('email', 'like', '%'.$this->searchTechnician.'%')
                    ->orWhere('identification', 'like', '%'.$this->searchTechnician.'%')->paginate(10);


        return view('livewire.admin.users', [
            'admins' => $admins,
            'technicians' => $technicians,
        ]);
    }
}
