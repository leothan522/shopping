@extends('layouts.ogani.master')

@section('title', 'Home')

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
    @include('web.funciones_ajax')
    <script type="text/javascript">console.log('Hi!')</script>
@endsection
