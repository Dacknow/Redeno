@extends('technician.back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Recuperar Contraseña')
@section('content')

    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-dark">Recuperar Contraseña</h2>
        </div>
        <h6 class="mb-20">
            Ingrese su dirección de correo electrónico para restablecer su contraseña
        </h6>
        <form action="{{route('tSend-password-reset-link')}}" method="POST">
            <x-form-alerts></x-form-alerts>
            @csrf
            
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" placeholder="Dirección de correo electrónico" name="email" value="{{old('email')}}">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                </div>
            </div>

            @error('email')
            <div class="d-block text-danger" style="margin-top: -25px; margin-botton: 15px;">
                {{$message}}
            </div>
            @enderror
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="input-group mb-0">                    
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Enviar">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-0">
                        <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('tLogin') }}">Iniciar Sesión</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection