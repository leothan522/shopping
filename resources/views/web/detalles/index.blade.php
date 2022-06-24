@extends('layouts.ogani.master')

@section('title', 'Home')

@section('content')
    @include('web.detalles.destils')

@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    <script type="text/javascript">console.log('Hi!');</script>
@endsection
