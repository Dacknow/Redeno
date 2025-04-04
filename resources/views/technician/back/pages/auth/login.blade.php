@extends('technician.back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Redeno')
@section('content')
<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-dark">Técnico</h2>
    </div>
    <form action="{{route('tLogin-handler')}}" method="POST">

        <x-form-alerts></x-form-alerts>
        @csrf

        <div class="input-group custom mb-1">
            <input type="text" class="form-control form-control-lg" placeholder="Usuario/Dirección de correo electrónico"
            name="login_id" value="{{ old('login_id') }}">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>

        @error('login_id')
            <span class="text-danger ml-1">{{$message}}</span>
        @enderror

        <div class="input-group custom mb-1 mt-2">
            <input type="password" class="form-control form-control-lg" placeholder="**********"
            name="password" >
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('password')
            <span class="text-danger ml-1">{{$message}}</span>
        @enderror
        
        <div class="row pb-30">
            <div class="col-5">
                <div class="input-group">
                    <a href="{{route('tRegister')}}">Crear Cuenta</a>
                </div>
            </div>
            <div class="col-7">
                <div class="forgot-password">
                    <a href="{{route('tForgot-password')}}">Recuperar Contraseña</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection