<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(Request $request){
        $data = [
            'pageTitle' => 'Login'
        ];
        return view('admin.back.pages.auth.login', $data);
    }

    public function forgotForm(Request $request){
        $data = [
            'pageTitle' => 'Forgot Password'
        ];
        return view('admin.back.pages.auth.forgot', $data);
    }
    public function loginFormTechnician(Request $request){
        $data = [
            'pageTitle' => 'Login'
        ];
        return view('technician.back.pages.auth.login', $data);
    }

    public function forgotFormTechnician(Request $request){
        $data = [
            'pageTitle' => 'Forgot Password'
        ];
        return view('technician.back.pages.auth.forgot', $data);
    }

    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email'){
            $request->validate([
                'login_id'=>'required|email|exists:admins,email',
                'password'=>'required|min:5|max:45'
            ],[
                'login_id.required'=>'Se requiere del Correo electrónico o Usuario',
                'login_id.email'=>'Correo electrónico inválido',
                'login_id.exists'=>'Correo electrónico no existe en el sistema',
                'password.required'=>'Se requiere la contraseña'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:admins,username',
                'password'=>'required|min:5|max:45'
            
            ],[
                'login_id.required'=>'Se requiere Correo electrónico o Usuario',
                'login_id.exists'=>'Usuario no existe en el sistema',
                'password.required'=>'Se requiere la contraseña'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password'=>$request->password
        );

        if(Auth::guard('admin')-> attempt($creds) ){
            return redirect()-> route('admin.dashboard');
        }else{
            session()->flash('fail','Credenciales Incorrectas');
            return redirect()-> route('admin.login');
        }
    }
}