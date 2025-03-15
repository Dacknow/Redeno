@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Perfil')
@section('content')


@livewire('admin.profile')

@endsection

@push('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{ asset('back/vendors/styles/myStyles.css') }}">
@endpush

@push('scripts')
    <script>
        window.addEventListener('updateAdminInfo', function (event) {
            $('#adminProfileName').html(event.detail.adminName);
            $('#adminProfileEmail').html(event.detail.adminEmail);
            $('#adminProfileUsername').html(event.detail.adminUsername);
            $('#statusIndicator').html(event.detail.statusIndicator);
            });
    </script> 
@endpush
