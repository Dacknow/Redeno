@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Editar Técnico')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">	
            <div class="pd-20 card-box">
                
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-dark h4">Editar Técnico</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('users') }}?tab=technicians"><i class="icon dw dw-left-arrow2"></i></a>
                    </div>
                </div>

                <x-form-alerts></x-form-alerts>
                <form id="edit-technician-form" method="POST" action="{{route('users.update-technician',$technician)}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="name">Nombre Completo</label>
                                <input value="{{$technician->name}}" type="text" class="form-control" id="name" name="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">                                        
                            <div class="form-group">
                                <label for="username">Nombre de Usuario</label>
                                <input value="{{$technician->username}}" type="text" class="form-control" id="username" name="username">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input value="{{$technician->email}}" type="email" class="form-control" id="email" name="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="identification">Número de Cédula</label>
                                <input value="{{$technician->identification}}" type="text" class="form-control" id="identification" name="identification">
                                @error('identification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celphone">Número de Telefono</label>
                                <input value="{{$technician->celphone}}" type="text" class="form-control" id="celphone" name="celphone">
                                @error('celphone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>                                                    
                        </div>                                                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state" class="form-label">Estado</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="1" {{ $technician->state == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $technician->state == 0 ? 'selected' : '' }}>Inactivo</option>
                                </select>
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