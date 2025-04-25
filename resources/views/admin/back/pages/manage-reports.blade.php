@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Administrar Reportes')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">	

            @livewire('admin.manage-reports')
        </div>
    </div>
</div>
       
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