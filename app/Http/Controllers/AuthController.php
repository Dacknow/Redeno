<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    /**
     * Muestra el formulario de login para administradores.
     */
    public function loginForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Iniciar Sesión'
        ];
        return view('admin.back.pages.auth.login', $data);
    }

    /**
     * Muestra el formulario de recuperación de contraseña para administradores.
     */
    public function forgotForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Recuperar Contraseña'
        ];
        return view('admin.back.pages.auth.forgot-password', $data);
    }

    /**
     * Muestra el formulario de login para técnicos.
     */
    public function loginFormTechnician(Request $request)
    {
        $data = [
            'pageTitle' => 'Iniciar Sesión'
        ];
        return view('technician.back.pages.auth.login', $data);
    }

    /**
     * Muestra el formulario de recuperación de contraseña para técnicos.
     */
    public function forgotFormTechnician(Request $request)
    {
        $data = [
            'pageTitle' => 'Recuperar Contraseña'
        ];
        return view('technician.back.pages.auth.forgot-password', $data);
    }

    /**
     * Procesa el intento de login para administradores.
     */
    public function loginHandler(Request $request)
    {
        return $this->loginAttempt($request, 'admin', 'dashboard', 'admins');
    }

    /**
     * Procesa el intento de login para técnicos.
     */
    public function loginHandlerTechnician(Request $request)
    {
        return $this->loginAttempt($request, 'technician', 'home', 'technicians');
    }

    /**
     * Muestra el formulario de registro para técnicos.
     */
    public function registerFormTechnician()
    {
        $data = [
            'pageTitle' => 'Registro'
        ];
        return view('technician.back.pages.auth.register', $data);
    }

    /**
     * Método privado reutilizable para manejar el login tanto de administradores como técnicos.
     *
     * @param Request $request Datos del formulario
     * @param string $guard Nombre del guard (admin o technician)
     * @param string $redirectRoute Ruta a la cual redirigir si el login es exitoso
     * @param string $table Nombre de la tabla de usuarios correspondiente
     */
    private function loginAttempt(Request $request, $guard, $redirectRoute, $table)
    {
        // Determina si el campo login_id es un email o nombre de usuario
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Validación de los campos según el tipo de login_id
        $request->validate([
            'login_id' => 'required|' . ($fieldType == 'email' ? "email|exists:$table,email" : "exists:$table,username"),
            'password' => 'required|min:5|max:45'
        ], [
            'login_id.required' => 'Escriba su Nombre de Usuario o Correo electrónico',
            'login_id.email' => 'Correo Electrónico Inválido',
            'login_id.exists' => 'Usuario no existe en el sistema',
            'password.required' => 'Escriba su Contraseña'
        ]);

        // Crea el arreglo de credenciales para autenticar
        $creds = [
            $fieldType => $request->login_id,
            'password' => $request->password
        ];

        // Intenta autenticar usando el guard especificado
        if (Auth::guard($guard)->attempt($creds)) {
            $user = Auth::guard($guard)->user();

            // Si la cuenta está inactiva, se cierra la sesión
            if (!$user->state) {
                Auth::guard($guard)->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                session()->flash('fail', 'Cuenta Inactiva');
                return redirect()->route($guard === 'admin' ? 'login' : 'tLogin');
            }

            // Si la cuenta está activa, se registra manualmente la sesión
            DB::table('sessions')->insert([
                'id' => session()->getId(),
                'user_id' => $user->id,
                'guard' => $guard,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'payload' => json_encode(['login_id' => $request->login_id]),
                'last_activity' => now()->timestamp
            ]);

            // Redirige al panel correspondiente
            return redirect()->route($redirectRoute);
        }

        // Si las credenciales son incorrectas
        session()->flash('fail', 'Credenciales Incorrectas');
        return redirect()->route($guard === 'admin' ? 'login' : 'tLogin');
    }
}
