<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

class Profile extends Component
{
    public $admin;
    public $is_available;
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'=>['keep'=>true]];
    public $name, $username, $email, $user_id, $state;
    public $current_password, $new_password, $new_password_confirmation;

    public function selectTab($tab){
        $this->tab = $tab;
    }

    #[On('updateAdminInfo')]

    public function mount()
    {
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;
        $this->admin = Admin::findOrFail(auth('admin')->id());
        $this->name = $this->admin->name;
        $this->username = $this->admin->username;
        $this->email = $this->admin->email;
        $this->is_available = $this->admin->is_available;
        $this->state = $this->admin->state;
    }

    public function toggleAvailability()
    {
        $this->is_available = $this->is_available ? 0 : 1; // Alternar entre 0 y 1
        $this->admin->update(['is_available' => $this->is_available]);
        $this->dispatch('updateAdminHeaderInfo', 
            statusIndicator: $this->is_available,
        );
    }

    public function updatePersonalDetails(){
        $this->validate([
            'name'=>'required|min:2|max:44',
            'username'=>'required|min:2|max:44|unique:admins,username,'.$this->admin->id,
            'email'=>'required|email|max:149'                      
        ],[
            'name.required'=>'Se requiere que escriba un nombre',
            'name.min'=>'El nombre es demasiado corto',
            'name.max'=>'El nombre es demasiado largo',
            'username.required'=>'Se requiere que escriba un nombre de usuario',
            'username.min'=>'El nombre de usuario es demasiado corto',
            'username.max'=>'El nombre de usuario es demasiado largo',
            'username.unique'=>'El nombre de usuario ya existe',
            'email.required'=>'Se requiere que escriba un correo electrónico',
            'email.email'=>'La dirección de correo electrónico no es válida',
            'email.max'=>'La dirección de correo electrónico es demasiado larga'
        ]);

        Admin::find($this->admin->id)
            ->update([
                'name'=> $this->name,
                'email'=> $this->email,
                'username'=> $this->username
            ]);

            // Actualizar info admin
            $this->dispatch('updateAdminInfo', 
                adminName: $this->name,
                adminEmail: $this->email
            );

            $this->dispatch('updateAdminHeaderInfo', 
                adminUsername: $this->username,
                statusIndicator: $this->is_available,
            );
    

            // $this->showToastr('success', 'Su información ha sido actualiza!.');
            
            session()->flash('success', 'Su información ha sido actualiza!.');
            return view('livewire.admin.profile');
    }

    public function updatePassword(){
        $this->validate([
            'current_password'=>[
                'required', function($atributte, $value, $fail){
                    if(!Hash::check($value, Admin::find(auth('admin')->id())->password)){
                        return $fail(__('La  contraseña antigua es incorrecta'));
                    }
                }
            ],
            'new_password'=>'required|min:5|max:254|required_with:new_password_confirmation|
            same:new_password_confirmation',
            'new_password_confirmation'=>'required'
        ],[
            'current_password.required'=>'Se requiere que escriba su contraseña actual',
            'new_password.required'=>'Se requiere que escriba una nueva contraseña',
            'new_password.min'=>'La nueva contraseña es demasiado corta',
            'new_password.max'=>'La nueva contraseña es demasiado larga',
            'new_password.same'=>'Las contraseñas no coinciden',
            'new_password_confirmation.required'=>'Se requiere la confirmación de la nueva contraseña'

        ]);
        $query= Admin::findOrFail(auth('admin')->id())->update([
            'password'=> Hash::make($this->new_password)
        ]);

        if($query){
            $this->current_password = $this->new_password = $this->new_password_confirmation = null;
            
            session()->flash('success', 'Se cambió la Contraseña correctamente');
            return view('livewire.admin.profile');
        }else{
            session()->flash('fail', 'Algo salió mal');
        }
    }


    public function render()
    {
        return view('livewire.admin.profile', [
            'admin' => $this->admin
        ]);
    }
}

