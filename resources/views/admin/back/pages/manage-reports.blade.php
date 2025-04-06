@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Administrar Reportes')
@section('content')


            @livewire('admin.manage-reports')
       
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('success', message => {
            Swal.fire({
            text: message, 
            icon: 'success',
            confirmButtonText: 'OK'
            });
        });
        Livewire.on('error', message => {
            Swal.fire({
            text: message, 
            icon: 'error',
            confirmButtonText: 'OK'
            });
        });

    });
</script>

@endpush