@extends('layouts.ogani.master')

@section('title', 'Android | Home')

@section('content')

    @include('web.section_header')
    @include('web.home.section_hero')

    @if($listarCategorias->isNotEmpty())
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

    @if($listarUltimos->isNotEmpty())
        @include('web.home.section_latest')
    @endif

    @include('web.home.section_contacto')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    @include('web.funciones_ajax')
    <script type="text/javascript">console.log('Hi!')</script>
@endsection
