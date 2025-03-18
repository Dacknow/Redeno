<?php

namespace App\Livewire\Technician;

use Livewire\Component;
use App\Models\Technician;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;


class Profile extends Component
{
    public $technician;
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'=>['keep'=>true]];
    public $name, $username, $email, $technician_id, $state, $identification, $celphone;
    public $current_password, $new_password, $new_password_confirmation;
    protected $listeners = [
        'updateTechnicianInfo' => '$refresh'
    ];

    public function selectTab($tab){
        $this->tab = $tab;
    }

    // #[On('updatetechnicianInfo')]

    public function mount()
    {
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;
        $this->technician = Technician::findOrFail(auth('technician')->id());
        $this->technician_id = $this->technician->id;
        $this->name = $this->technician->name;
        $this->username = $this->technician->username;
        $this->email = $this->technician->email;
        $this->state = $this->technician->state;
        $this->identification = $this->technician->identification;
        $this->celphone = $this->technician->celphone;
    }   

    public function updatePersonalDetails(){
        $this->validate([
            'name'=>'required|min:2|max:44',
            'username'=>'required|min:2|max:44|unique:technicians,username,'.$this->technician_id,
            'email'=>'required|email|max:149',
            'identification'=>'required|min:8|max:11',
            'celphone'=>'required|min:10|max:10',          
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
            'email.max'=>'La dirección de correo electrónico es demasiado larga',
            'identification.required'=>'Se requiere que escriba su número de identificación',
            'identification.min'=>'El número de identificación es demasiado corto',
            'identification.max'=>'El número de identificación es demasiado largo',
            'celphone.required'=>'Se requiere que escriba su número de celular',
            'celphone.min'=>'El número de celular es demasiado corto',
            'celphone.max'=>'El número de celular es demasiado largo'
        ]);

        Technician::find($this->technician->id)
            ->update([
                'name'=> $this->name,
                'email'=> $this->email,
                'username'=> $this->username,
                'identification'=> $this->identification,
                'celphone'=> $this->celphone,
            ]);

            $this->dispatch('updateTechnicianInfo')->to(Profile::class);

            $this->dispatch('updateTechnicianHeaderInfo')->to(TopTechnicianInfo::class);
    

            // $this->showToastr('success', 'Su información ha sido actualiza!.');
            
            session()->flash('success', 'Su información ha sido actualiza!.');
            return view('livewire.technician.profile');
    }

    public function updatePassword(){
        $this->validate([
            'current_password'=>[
                'required', function($atributte, $value, $fail){
                    if(!Hash::check($value, technician::find(auth('technician')->id())->password)){
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
        $query= Technician::findOrFail(auth('technician')->id())->update([
            'password'=> Hash::make($this->new_password)
        ]);

        if($query){
            $this->current_password = $this->new_password = $this->new_password_confirmation = null;
            
            session()->flash('success', 'Se cambió la Contraseña correctamente');
            return view('livewire.technician.profile');
        }else{
            session()->flash('fail', 'Algo salió mal');
        }
    }


    public function render()
    {
        return view('livewire.technician.profile', [
            'technician' => $this->technician
        ]);
    }
}
