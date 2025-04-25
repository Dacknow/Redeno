@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Inicio')
@section('content')
<div class="main-container pd-0">
    <div class="min-height-200px">
        <!-- Vista de bienvenida -->
        <div class="container-fluid dashboard-container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-md-6">
                    <div class="welcome-card text-center">
                        <h1 class="welcome-title">¡Bienvenido, {{ auth('admin')->user()->name }}!</h1>
                        <p class="welcome-text">Nos alegra verte de nuevo. Gestiona tus reportes.</p>
                        <a href="{{ route('manage-reports') }}" class="btn btn-custom">Ir a mis reportes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection