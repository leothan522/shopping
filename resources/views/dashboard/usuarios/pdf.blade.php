@extends('dashboard.master_pdf')

@section('content')


    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @foreach($users as $user)
                    <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Usuario ID: <b class="text-danger">{{ $user->id }}</b>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ $user->name }}</b></h2>
                                    <p class="text-muted text-sm"><b>Role: </b> {{ role($user->role) }}</p>
                                    <p class="text-muted text-sm"><b>Email: </b> {{ strtolower($user->email)}}</p>
                                    <p class="text-muted text-sm"><b>Estatus: </b> {!!  estatusUsuario($user->estatus)  !!}</p>
                                    <p class="text-muted text-sm"><b>Created at: </b> {{ fecha($user->created_at) }}</p>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ verImagen($user->profile_photo_path, $user->name) }}" alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


@endsection
