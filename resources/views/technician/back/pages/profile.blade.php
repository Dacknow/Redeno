@extends('technician.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Perfil')
@section('content')


@livewire('technician.profile')

@endsection
@push('scripts')
    <script>
        $('input[type="file"][name="technicianProfilePictureFile"][id="technicianProfilePictureFile"]').ijaboCropTool({
           preview:'#technicianProfilePicturePreview',
           setRatio:1,
           allowedExtensions: ['jpg', 'jpeg','png'],
           buttonsText:['DEFINIR','QUITAR'],
           buttonsColor:['#30bf7d','#ee5155', -15],
           processUrl:'{{ route("tUpdate_profile_picture")}}',
           withCSRF:['_token','{{ csrf_token() }}'],
           onSuccess:function(message, element, status){
             Livewire.dispatch('updateTechnicianHeaderInfo');
              alert(message);
           },
           onError:function(message, element, status){
             alert(message);
           }
        });
 </script>
@endpush
