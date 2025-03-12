@extends('technician.back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reestablecer Contraseña')
@section('content')
<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Reestablecer Contraseña</h2>
    </div>
    <h6 class="mb-20">Ingrese su nueva contraseña y confírmela</h6>
    <form action="{{ route('tReset-password-handler', ['token'=>request()->token]) }}" method="POST">
        @csrf

        <x-form-alerts></x-form-alerts>
        <div class="input-group custom">
            <input type="password" class="form-control form-control-lg" placeholder="Nueva Contraseña"
            name="new_password" value="{{ old('new_password')}}">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('new_password')
            <div class="d-block text-danger" styles="margin-top:-25px; margin-boton:25px">{{$message}}</div>            
        @enderror
        <div class="input-group custom">
            <input type="password" class="form-control form-control-lg" placeholder="Confirme la Nueva Contraseña"
            name="new_password_confirmation" value="{{ old('new_password_confirmation')}}">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('new_password_confirmation')
            <div class="d-block text-danger" styles="margin-top:-25px; margin-boton:25px">{{$message}}</div>            
        @enderror
        <div class="row align-items-center">
            <div class="col-5">
                <div class="input-group mb-0">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Enviar">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection