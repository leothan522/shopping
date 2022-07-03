@extends('layouts.ogani.master')

@section('title', 'Caracas Shopping | Checkout')

@section('content')
    @include('web.checkout.checkout')
    @include('web.section_contacto')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    @include('web.funciones_ajax')
    <script type="text/javascript">console.log('Hi!')</script>
@endsection
