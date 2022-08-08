@extends('layouts.ogani.master')

@section('title', 'Caracas Shopping | Inicio')

@section('content')

    @include('web.section_header')
    @include('web.home.section_hero')

    {{--@include('web.section_breadcrumb')--}}

    @if($listarCategorias->isNotEmpty() /*&& $ruta != 'android'*/)
        @include('web.home.section_categories')
    @endif

    @if($listarDestacados->isNotEmpty())
        @include('web.home.section_featured')
        @else
        <br class="mt-3">
    @endif

    @if($listarBanner->isNotEmpty())
        @include('web.home.section_banner')
    @endif

    @if($listarUltimos->isNotEmpty() && $listarUltimos->count() >= 4)
        @include('web.home.section_latest')
    @endif

    @include('web.section_contacto')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    @if(\Illuminate\Support\Facades\Route::currentRouteName() != "web.index")
        @include('web.funciones_ajax')
    @endif
    @include('web.funciones_android')
    <script type="text/javascript">
        console.log('Hi!')
    </script>
@endsection
