@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Perfil')
@section('content')


@livewire('admin.profile')

@endsection
@push('scripts')
    <script>
        $('input[type="file"][name="adminProfilePictureFile"][id="adminProfilePictureFile"]').ijaboCropTool({
           preview:'#adminProfilePicturePreview',
           setRatio:1,
           allowedExtensions: ['jpg', 'jpeg','png'],
           buttonsText:['DEFINIR','QUITAR'],
           buttonsColor:['#30bf7d','#ee5155', -15],
           processUrl:'{{ route("update_profile_picture")}}',
           withCSRF:['_token','{{ csrf_token() }}'],
           onSuccess:function(message, element, status){
             Livewire.dispatch('updateAdminHeaderInfo');
              alert(message);
           },
           onError:function(message, element, status){
             alert(message);
           }
        });
 </script>
@endpush
