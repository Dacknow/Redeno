@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Editar Administrador')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">	
            <div class="pd-20 card-box">
                <div class="pull-right">
                    <a href="{{ route('users') }}?tab=admins"><i class="icon dw dw-left-arrow2"></i></a>
                </div>
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-dark h4">Editar Administrador</h4>
                    </div>
                </div>

                <x-form-alerts></x-form-alerts>
                <form id="edit-admin-form" method="POST" action="{{route('users.update-admin',$admin)}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="name">Nombre Completo</label>
                                <input value="{{$admin->name}}" type="text" class="form-control" id="name" name="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">                                        
                            <div class="form-group">
                                <label for="username">Nombre de Usuario</label>
                                <input value="{{$admin->username}}" type="text" class="form-control" id="username" name="username">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input value="{{$admin->email}}" type="email" class="form-control" id="email" name="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                                                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state" class="form-label">Estado</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="1" {{ $admin->state == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $admin->state == 0 ? 'selected' : '' }}>Inactivo</option>
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
                                                {{ $admin->roles->contains('id', $role->id) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('roles')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>                                                                                
                        </div>                                                    
                    </div>                                                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Actualizar Cambios</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection