@extends('adminlte::page')

@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pedidos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item active">Pedidos Realizados</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection

@section('content')
    @livewire('pedidos-component')
@endsection

@section('footer')
    @include('dashboard.footer')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $('#swalDefaultInfo').submit(function() {
                Toast.fire({
                    icon: 'info',
                    title: 'Generando Archivo'
                })
            });

        });
        console.log('Hi!');
    </script>
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection
