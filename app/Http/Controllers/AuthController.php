<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}