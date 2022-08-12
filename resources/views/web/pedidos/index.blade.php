@extends('layouts.ogani.master')

@section('title', 'Caracas Shopping | Pedidos')

@section('content')

    @include('web.section_header')
    @include('web.pedidos.section_hero')
    @include('web.section_contacto')

@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    @include('web.funciones_ajax')
    @include('web.funciones_android')
    <script type="text/javascript">console.log('Hi!')</script>
@endsection
