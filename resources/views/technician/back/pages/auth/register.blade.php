@extends('technician.back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Crear Cuenta')
@section('content')

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Crear Cuenta</h2>
    </div>
    <form action="{{ route('tRegister-handler') }}" method="post">
        <x-form-alerts></x-form-alerts>        
        @csrf        

        <!-- Nombre Completo -->
        <div class="input-group custom">
            <input type="text" class="form-control form-control-lg" placeholder="Nombre Completo"
            name="name" value="{{ old('name') }}">    
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>
        @error('name')
            <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px;">
                {{ $message }}
            </div>
        @enderror

        <!-- Correo Electrónico -->
        <div class="input-group custom">
            <input type="email" class="form-control form-control-lg" placeholder="Correo Electrónico"
            name="email" value="{{ old('email') }}">    
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-email"></i></span>
            </div>
        </div>
        @error('email')
            <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px;">
                {{ $message }}
            </div>
        @enderror
        <!-- Username -->
        <div class="input-group custom">
            <input type="text" class="form-control form-control-lg" placeholder="Nombre de Usuario"
            name="username" value="{{ old('username') }}">    
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user3"></i></span>
            </div>
        </div>
        @error('username')
            <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px;">
                {{ $message }}
            </div>
        @enderror

        <!-- Número de Identificación -->
        <div class="input-group custom">
            <input type="text" class="form-control form-control-lg" placeholder="Número de Cédula"
            name="identification" value="{{ old('identification') }}">    
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-id-card"></i></span>
            </div>
        </div>
        @error('identification')
            <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px;">
                {{ $message }}
            </div>
        @enderror

        <!-- Teléfono -->
        <div class="input-group custom">
            <input type="text" class="form-control form-control-lg" placeholder="Teléfono"
            name="celphone" value="{{ old('celphone') }}">    
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-smartphone-1"></i></span>
            </div>
        </div>
        @error('celphone')
            <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px;">
                {{ $message }}
            </div>
        @enderror

        <!-- Nueva Contraseña -->
        <div class="input-group custom">
            <input type="password" class="form-control form-control-lg" placeholder="Nueva Contraseña"
            name="new_password">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('new_password')
            <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 25px;">
                {{ $message }}
            </div>            
        @enderror

        <!-- Confirmar Nueva Contraseña -->
        <div class="input-group custom">
            <input type="password" class="form-control form-control-lg" placeholder="Confirmar Nueva Contraseña"
            name="new_password_confirmation">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('new_password_confirmation')
            <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 25px;">
                {{ $message }}
            </div>            
        @enderror

        <!-- Botones de acción -->
        <div class="row align-items-center">
            <div class="col-6">
                <div class="input-group mb-0">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Registrarme">
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-0">
                    <a href="{{ route('tLogin') }}" class="btn btn-secondary btn-lg btn-block">¿Ya tienes cuenta?</a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
