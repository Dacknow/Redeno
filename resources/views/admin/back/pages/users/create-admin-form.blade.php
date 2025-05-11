@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Crear Administrador')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px ">	
            <div class="pd-20 card-box ">
                <div class="pull-right">
                    <a href="{{ route('users.index') }}?tab=admins"><i class="icon dw dw-left-arrow2"></i></a>
                </div>
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-dark h4">Crear Administrador</h4>
                    </div>
                </div>

                <x-form-alerts></x-form-alerts>
                <form id="create-admin-form" method="POST" action="{{route('users.store-admin')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="name">Nombre Completo</label>
                                <input value="{{old('name')}}" type="text" class="form-control" id="name" name="name" placeholder="Escriba el nombre completo">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">                                        
                            <div class="form-group">
                                <label for="username">Nombre de Usuario</label>
                                <input value="{{old('username')}}" type="text" class="form-control" id="username" name="username" placeholder="Escriba un nombre de usuario">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input value="{{old('email')}}" type="email" class="form-control" id="email" name="email" placeholder="Escriba una dirección de correo electrónico">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                                                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state" class="form-label">Estado</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="" selected>Seleccione un Estado</option>
                                    <option value="1" >Activo</option>
                                    <option value="0" >Inactivo</option>
                                </select>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>                                                    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Asignar Rol</label>
                                <div>
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $role->name }}</label>
                                        </div>
                                    @endforeach 
                                    @error('roles')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                                                              
                        </div>
                        <!-- Nueva Contraseña -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password">Contraseña</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nueva contraseña">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmar Nueva Contraseña -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirmar Contraseña</label>
                                <input type="password" class="form-control" placeholder="Confirmar Nueva Contraseña" name="new_password_confirmation">        
                                @error('new_password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>            
                                @enderror                                                    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Crear Administrador</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection