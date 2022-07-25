@extends('layouts.ogani.master')

@section('title', 'Caracas Shopping | Busqueda')

@section('content')
    @include('web.section_header')
    @include('web.section_breadcrumb')
    @if($modulo == "Busqueda")
        <br>
        @include('web.home.section_hero')
        @include('web.busqueda.resultados')
        @else
        @include('web.busqueda.empresas')
        @include('web.busqueda.section_banner')
    @endif
    @include('web.section_contacto')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    @if(\Illuminate\Support\Facades\Route::currentRouteName() != "web.busqueda" && \Illuminate\Support\Facades\Route::currentRouteName() != "web.tienda")
        @include('web.funciones_ajax')
    @endif
    <script type="text/javascript">console.log('Hi!')</script>
@endsection
