@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Perfil')
@section('content')

<x-form-alerts></x-form-alerts>

@livewire('admin.profile')

@endsection
@push('scripts')
    {{-- <script>
        $('input[type="file"][id="adminProfilePictureFile"]').kropify({
            preview:'image#adminProfilePicturePreview',
            viewMode:1,
            aspectRatio:1,
            cancelButtonText:'Cancel',
            resetButtonText:'Reset',
            cropButtonText:'Crop & update',
            processURL:'{{route("update_profile_picture")}}',
            processMethod: 'POST',
            maxSize:2097152, //2MB
            showLoader:true,
            animationClass:'headShake', //headShake, bounceIn, pulse
            fileName:'adminProfilePictureFile',
            success:function(data){
                if(data.status == 1){
                    $().notifa({
                        vers:2,
                        cssClass:'success',
                        html:data.message,
                        delay:2500
                    });
                }else{
                    $().notifa({
                        vers:2,
                        cssClass:'error',
                        html:data.message,
                        delay:2500
                    });
                }
            },
            errors:function(error, text){
                console.log(text);
            },
        });
    </script> --}}
    <script>
        $('input[type="file"][name="adminProfilePictureFile"][id="adminProfilePictureFile"]').ijaboCropTool({
           preview:'#adminProfilePicturePreview',
           setRatio:1,
           allowedExtensions: ['jpg', 'jpeg','png'],
           buttonsText:['DEFINIR','QUITAR'],
           buttonsColor:['#30bf7d','#ee5155', -15],
           processUrl:'{{ route('update_profile_picture')}}',
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
