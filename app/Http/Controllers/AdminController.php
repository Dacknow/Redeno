<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use constGuards;
use constDefaults;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{

    public function dashboard(){
        $data = [
            'pageTitle' => 'Dashboard'
        ];
        return view('admin.back.pages.dashboard', $data);
    }

    
    public function logoutHandler(Request $request)
    {
        Auth::guard('admin')->logout(); // Cierra la sesión del guard 'admin'
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF

        if (!Auth::guard('admin')->check()) {
            session()->flash('success', 'You are logged out !!!');
        } else {
            session()->flash('fail', 'Logout failed. Try again.');
        }

        return redirect()->route('login');
    }


    public function sendPasswordResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:admins,email'
        ],[    
            'email.required'=>'Email address required',
            'email.email'=>'Invalid email address',
            'email.exists'=>'Email address is not exists in system'
        ]);

        // traer detalles del admin

        $admin = Admin::where('email',$request->email)->first();

        // generar token

        $token = base64_encode(Str::random(64));

        // verificar si existe un token 

        $oldToken = DB::table('password_reset_tokens')
                        ->where(['email'=>$request->email,'guard'=>constGuards::ADMIN])
                        -> first();

        if($oldToken){
            //actualizar token
            DB::table('password_reset_tokens')
            ->where(['email'=>$request->email,'guard'=>constGuards::ADMIN])
            -> update([
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
        }else{
            // añadir un nuevo token

            DB::table('password_reset_tokens')->insert([
                'email'=>$request->email,
                'guard'=>constGuards::ADMIN,
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
        }

        $actionLink = route('reset-password', ['token'=>$token, 'email'=>$request->email]);

        $data = array(
            'actionLink'=> $actionLink,
            'admin'=>$admin
        );

        $mail_body = view('email-templates.admin-forgot-email-template', $data)->render();

        $mailConfig= array(
            'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('EMAIL_FROM_NAME'),
            'mail_recipient_email'=> $admin->email,
            'mail_recipient_name'=> $admin->name,
            'mail_subject'=>'Reset password',
            'mail_body'=>$mail_body

        );

        if(sendEmail($mailConfig)){
            session()->flash('success', 'Te enviamos un correo');
            return redirect()->route('forgot-password');
        }else{
            session()->flash('fail', 'Algo salió mal!');
            return redirect()->route('forgot-password');
        }

    }

    public function resetPassword(Request $request, $token = null){
            
        
        $check_token= DB::table('password_reset_tokens')
                        ->where(['token'=>$token, 'guard'=>constGuards::ADMIN])
                        ->first();

        if($check_token){
            // verificar si no esta expirado el token

            $diffMins=Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());
        
            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                # si expiró
                session()->flash('fail', 'El tiempo Expiró!, intenta de nuevo');
                return redirect()->route('forgot-password', ['token'=>$token]);
        

            } else {
                return view('admin.back.pages.auth.reset-password', ['token'=>$token]);
        
            }
            
        }else{
            session()->flash('fail', 'Token Inválido!, intenta de nuevo');
            return redirect()->route('forgot-password', ['token'=>$token]);
        }
    }

    public function resetPasswordHandler(Request $request){
        $request->validate([
            'new_password'=>'required|min:5|max:45|required_with:new_password_confirmation|
            same:new_password_confirmation',
            'new_password_confirmation'=>'required'
        ],[
            'new_password.required'=>'Se requiere que escriba una nueva contraseña',
            'new_password.min'=>'La nueva contraseña es demasiado corta',
            'new_password.max'=>'La nueva contraseña es demasiado larga',
            'new_password.same'=>'Las contraseñas no coinciden',
            'new_password_confirmation.required'=>'Se requiere la confirmación de la nueva contraseña'
        ]);

        $token = DB::table('password_reset_tokens')
                    ->where(['token'=>$request->token, 'guard'=>constGuards::ADMIN])
                    ->first();
        
        //traer datos del usuario admin
        $admin = admin::where('email', $token->email)->first();

        //actualizar contraseña del usuario admin
        admin::where('email', $admin->email)->update([
            'password'=>Hash::make($request->new_password)
        ]);
        // borrar token
        DB::table('password_reset_tokens')->where([
            'email'=>$admin->email,
            'token'=>$request->token,
            'guard'=>constGuards::ADMIN
        ])->delete();

        //enviar correo de notificacion al usuario
        $data = array(
            'admin'=>$admin,
            'new_password'=>$request->new_password
        );

        $mail_body = view('email-templates.admin-reset-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('EMAIL_FROM_NAME'),
            'mail_recipient_email'=>$admin->email,
            'mail_recipient_name'=>$admin->name,
            'mail_subject'=>'Contraseña Reestablecida',
            'mail_body'=> $mail_body
        );
        
        sendEmail($mailConfig);
        return redirect()->route('login')->with('success','Listo!, Tu contraseña ha sido reestablecida');
    }

    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
