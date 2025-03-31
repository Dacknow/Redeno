@extends('technician.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reportes')
@section('content')

@livewire('technician.reports')

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
