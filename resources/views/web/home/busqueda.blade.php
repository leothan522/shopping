@extends('layouts.ogani.master')

@section('title', 'Home')

@section('content')
    @include('web.section_header')
    {{--@include('web.home.section_hero')--}}
    @include('web.home.section_featured')
    @include('web.home.section_contacto')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    @include('web.funciones_ajax')
    <script type="text/javascript">console.log('Hi!')</script>
@endsection
