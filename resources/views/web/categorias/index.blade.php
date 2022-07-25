@extends('layouts.ogani.master')

@section('title', 'Caracas Shopping | Categorias')

@section('content')
    @include('web.section_header')
    @include('web.section_breadcrumb')
    @include('web.categorias.section_product')
    @include('web.section_contacto')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    @if(\Illuminate\Support\Facades\Route::currentRouteName() != "guest.categorias")
        @include('web.funciones_ajax')
    @endif
    <script type="text/javascript">console.log('Hi!')</script>
@endsection
