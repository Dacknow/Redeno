@extends('admin.back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Usuarios')
@section('content')
@livewire('admin.users')
@endsection