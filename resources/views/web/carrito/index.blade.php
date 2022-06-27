@extends('layouts.ogani.master')

@section('title', 'Home')

@section('content')
    @include('web.carrito.carrito')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    @include('web.funciones_ajax')
    <script type="text/javascript">console.log('Hi!')</script>
@endsection
