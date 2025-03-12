<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(Request $request){
        $data = [
            'pageTitle' => 'Iniciar Sesión'
        ];
        return view('admin.back.pages.auth.login', $data);
    }

    public function forgotForm(Request $request){
        $data = [
            'pageTitle' => 'Recuperar Contraseña'
        ];
        return view('admin.back.pages.auth.forgot-password', $data);
    }
    public function loginFormTechnician(Request $request){
        $data = [
            'pageTitle' => 'Iniciar Sesión'
        ];
        return view('technician.back.pages.auth.login', $data);
    }

    public function forgotFormTechnician(Request $request){
        $data = [
            'pageTitle' => 'Recuperar Contraseña'
        ];
        return view('technician.back.pages.auth.forgot-password', $data);
    }

    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email'){
            $request->validate([
                'login_id'=>'required|email|exists:admins,email',
                'password'=>'required|min:5|max:45'
            ],[
                'login_id.required' => 'Se requiere nombre de usuario o correo electrónico',
                'login_id.email' => 'Dirección de correo electrónico no válida',
                'login_id.exists' => 'El correo electrónico no existe en el sistema',
                'password.required' => 'Se requiere contraseña'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:admins,username',
                'password'=>'required|min:5|max:45'
            
            ],[
                'login_id.required'=>'username or email is required',
                'login_id.exists'=>'user is not exists in system',
                'password.required'=>'password is required'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password'=>$request->password
        );

        if(Auth::guard('admin')->attempt($creds) ){
            return redirect()-> route('dashboard');
            
        }else{
            session()->flash('fail','Incorrect Credentials');
            return redirect()-> route('login');
        }
    }

    public function loginHandlerTechnician(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email'){
            $request->validate([
                'login_id'=>'required|email|exists:technicians,email',
                'password'=>'required|min:5|max:45'
            ],[
                'login_id.required'=>'username or email is required',
                'login_id.email'=>'invalid email address',
                'login_id.exists'=>'email is not exists in system',
                'password.required'=>'password is required'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:technicians,username',
                'password'=>'required|min:5|max:45'
            
            ],[
                'login_id.required'=>'username or email is required',
                'login_id.exists'=>'user is not exists in system',
                'password.required'=>'password is required'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password'=>$request->password
        );

        if(Auth::guard('technician')->attempt($creds) ){
            return redirect()-> route('home');
        }else{
            session()->flash('fail','Incorrect Credentials ');
            return redirect()-> route('tLogin');
        }
    }
}