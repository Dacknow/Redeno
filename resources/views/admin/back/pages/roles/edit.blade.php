@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Editar Rol')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">	
            <div class="pd-20 card-box">
                <div class="pull-right">
                    <a href="{{ route('roles.index') }}"><i class="icon dw dw-left-arrow2"></i></a>
                </div>
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-dark h4">Editar Rol</h4>
                    </div>
                </div>

                <x-form-alerts></x-form-alerts>

                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <div class="h5">
                            <label for="name">Nombre</label>
                        </div>
                        <input type="text" name="name" id="name" class="form-control" 
                            placeholder="Ingrese el nombre de un rol" value="{{ old('name', $role->name) }}">
                        @error('name') 
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <h4 class="text-dark h4">Listado de permisos</h4>
                    @foreach ($permissions as $permission)
                        <div>
                            <label>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                    class="mr-1"
                                    {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary btn-sm">Actualizar rol</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
@endpush