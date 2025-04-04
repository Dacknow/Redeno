<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                'login_id.required' => 'Escriba su nombre de usuario o correo electrónico',
                'login_id.email' => 'Dirección de correo electrónico inválido',
                'login_id.exists' => 'El correo electrónico no existe en el sistema',
                'password.required' => 'Escriba su contraseña'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:admins,username',
                'password'=>'required|min:5|max:45'
            
            ],[
                'login_id.required'=>'Escriba su nombre de usuario o correo electrónico',
                'login_id.exists'=>'El nombre de usuario no no existe en el sistema',
                'password.required'=>'Escriba su contraseña'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password'=>$request->password
        );

        if(Auth::guard('admin')->attempt($creds) ){
            $admin = Auth::guard('admin')->user();

            if(!$admin->state){
                Auth::guard('admin')->logout(); // Cierra la sesión del guard 'admin'
                $request->session()->invalidate(); // Invalida la sesión
                $request->session()->regenerateToken(); // Regenera el token CSRF
                session()->flash('fail','Cuenta Inactiva');
                return redirect()->route('login');
            }else{
            
                // Insertar datos en la tabla `sessions`
                DB::table('sessions')->insert([
                    'id' => session()->getId(),
                    'user_id' => $admin->id,
                    'guard' => 'admin', // Especificamos el guard
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'payload' => json_encode(['login_id' => $request->login_id]),
                    'last_activity' => now()->timestamp
                ]);
                
                return redirect()-> route('dashboard');
            }
            
        }else{
            session()->flash('fail','Credenciales Incorrectas');
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
                'login_id.required'=>'Escriba su Nombre de Usuario o Correo electrónico',
                'login_id.email'=>'Correo Electrónico Inválido',
                'login_id.exists'=>'Usuario no existe en el  sistema',
                'password.required'=>'Escriba su Contraseña'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:technicians,username',
                'password'=>'required|min:5|max:45'
            
            ],[
                'login_id.required'=>'Escriba su Nombre de Usuario o Correo electrónico',
                'login_id.exists'=>'Usuario no existe en el  sistema',
                'password.required'=>'Escriba su Contraseña'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password'=>$request->password
        );        

        if(Auth::guard('technician')->attempt($creds) ){
            $technician = Auth::guard('technician')->user();

            if(!$technician->state){
                Auth::guard('technician')->logout(); // Cierra la sesión del guard 'admin'
                $request->session()->invalidate(); // Invalida la sesión
                $request->session()->regenerateToken(); // Regenera el token CSRF
                session()->flash('fail','Cuenta Inactiva');
                return redirect()->route('tLogin');
            }else{
            // Insertar datos en la tabla `sessions`
                DB::table('sessions')->insert([
                    'id' => session()->getId(),
                    'user_id' => $technician->id,
                    'guard' => 'technician', // Especificamos el guard
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'payload' => json_encode(['login_id' => $request->login_id]),
                    'last_activity' => now()->timestamp
                ]);
                return redirect()-> route('home');
            }
        }else{
            session()->flash('fail','Credenciales Incorrectas');
            return redirect()-> route('tLogin');
        }
    }
    public function registerFormTechnician(){
        $data = [
            'pageTitle' => 'Registro'
        ];
        return view('technician.back.pages.auth.register', $data);
    }
}