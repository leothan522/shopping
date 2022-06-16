<div wire:ignore.self class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content fondo">
            <div class="modal-header">
                {{--<h4 class="modal-title">Large Modal</h4>--}}
                <button type="button" wire:click="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{--@if(!$user_id)
                    <div class="overlay">
                        <i class="fas fa-2x fa-sync-alt"></i>
                    </div>
                @endif
                --}}
                    <div wire:loading>
                        <div class="overlay">
                            <i class="fas fa-2x fa-sync-alt"></i>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                    <div class="row col-md-11">

                        <div class="col-md-6">
                            <div class="card card-purple card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="{{ verImagen($user_path, $user_name) }}" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center">{{ ucwords($user_name) }}</h3>

                                    {{--<p class="text-muted text-center">{!! iconoPlataforma($user->plataforma) !!}</p>--}}

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right">{{ $user_email }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Rol</b> <a class="float-right">@if($user_role){{ role($user_role) }}@else {{ role(0) }}@endif</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Estatus</b> <a class="float-right text-danger">@if($user_estatus) {!! estatusUsuario($user_estatus) !!} @else {!! estatusUsuario(0)  !!} @endif</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Registro</b> <a class="float-right">@if($user_fecha) {{ haceCuanto($user_fecha) }} @endif</a>
                                        </li>
                                        @if($user_password)
                                            <li class="list-group-item">
                                                <b class="text-warning">Nueva Contraseña</b> <input type="text" wire:model.defer="user_password" class="form-control col-sm-4 form-control-sm float-right" />
                                            </li>
                                        @endif
                                    </ul>

                                    <input type="hidden" name="mod" value="status">
                                    @if ($user_id && ((leerJson(Auth::user()->permisos, 'usuarios.update') ||
                                            Auth::user()->role == 1 || Auth::user()->role == 100) &&
                                            $user_id != Auth::user()->id))

                                        <div class="row">
                                            <div class="col-md-6">
                                                @if ($user_estatus)
                                                    <button type="button" wire:click="cambiarEstatus({{ $user_id }})" class="btn btn-danger btn-block"><b>Suspender Usuario</b></button>
                                                @else
                                                    <button type="button" wire:click="cambiarEstatus({{ $user_id }})" class="btn btn-success btn-block"><b>Activar Usuario</b></button>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" wire:click="restablecerClave({{ $user_id }})" class="btn btn-block btn-secondary"><b>Restablecer Contraseña</b></button>
                                            </div>
                                        </div>

                                    @endif


                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h5 class="card-title">Editar Usuario</h5>
                                    <div class="card-tools">
                                        <span class="btn btn-tool"><i class="fas fa-user-edit"></i></span>
                                    </div>
                                </div>
                                <div class="card-body">

                                    {!! Form::open(['wire:submit.prevent' => "update(${user_id})"]) !!}
                                    @if (/*$user->plataforma == 0*/true)
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre y Apellido', 'wire:model.defer' => 'user_name']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'wire:model.defer' => 'user_email']) !!}
                                                @error('user_email')
                                                <span class="col-sm-12 text-sm text-bold text-danger">
                                                    <i class="icon fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    @if ($user_role != 100 && $user_id != Auth::user()->id)
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ __('Role') }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                                </div>
                                                {{--{!! Form::select('role', role() , null, ['class' => 'custom-select', 'wire:model.debounce.10000ms' => 'user_role']) !!}--}}
                                                <select name="role" class="custom-select" wire:model.defer="user_role">
                                                    {{--<option value="{{  }}">Seleccione</option>--}}
                                                    <option value="0">Estandar</option>
                                                    @foreach($list_roles as $rol)
                                                        <option value="{{ $rol->id }}">{{ ucwords($rol->nombre) }}</option>
                                                    @endforeach
                                                    @if(auth()->user()->role == 1 || auth()->user()->role ==100)
                                                        <option value="1">Administrador</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <input type="hidden" name="role" value="{{--{{ $user->role }}--}}">
                                    @endif

                                    <div class="form-group text-right">
                                        <input type="hidden" name="mod" value="datos">
                                        @if (/*$user->role != 100 || Auth::user()->role == 100*/ $user_id)
                                            @if (/*$user->status != 0*/true)
                                                <input type="submit" class="btn btn-block btn-primary" value="Guardar Cambios">
                                            @else
                                                <input type="button" class="btn btn-block btn-primary disabled" value="Guardar Cambios">
                                            @endif
                                        @endif

                                    </div>

                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" wire:click="limpiar()" class="btn btn-default btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
