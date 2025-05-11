@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Lista de roles')
@section('content')
<div class="main-container">
    <div class="card-box mx-3 mt-4 pd-20">
        <div class="pd-20 min-height-200px">
                       
            <div class="pull-left">
                <h4 class="text-dark h4">Listado de Roles</h4>
            </div>
            @if(auth('admin')->user()->can('roles.create'))
                <div class="pull-right">
                    <a href="{{ route('roles.create') }}"><i class="icon dw dw-add"></i></a>
                </div>
            @endif
            <x-form-alerts></x-form-alerts>
            @if($roles->count())
    
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Rol</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th >{{$role->id}}</th>
                            <td>{{$role->name}}</td>
                            <td>
                                @if(auth('admin')->user()->can('roles.edit'))
                                    <a href="{{route('roles.edit', $role)}}" class="btn btn-info btn-sm">Editar</a>
                                @endif
                            </td>
                            <td>
                                @if(auth('admin')->user()->can('roles.destroy'))                                
                                    <form action="{{route('roles.destroy', $role)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>                                
                                @endif
                            </td>
                        </tr> 
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            @else
                <div class="card-body">
                    <strong>No hay roles</strong>
                </div>
            @endif
        </div>
    </div>
</div>
    
@endsection
@push('scripts')
@endpush