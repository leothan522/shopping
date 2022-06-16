<div class="col-md-3">

    <div class="card card-gray-dark" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
        <div class="card-header">
            <h3 class="card-title">Nuevo Usuario</h3>
            <div class="card-tools">
                {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>--}}
                <span class="btn btn-tool"><i class="fas fa-user-plus"></i></span>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">


            {!! Form::open(['wire:submit.prevent' => 'store']) !!}

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    {!! Form::text('name', null, ['class' => 'form-control', 'wire:model.defer' => 'name', 'placeholder' => 'Nombre y Apellido']) !!}
                    @error('name')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    {!! Form::email('email', null, ['class' => 'form-control', 'wire:model.defer' => 'email', 'placeholder' => 'Email']) !!}
                    @error('email')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Password') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    {!! Form::text('password', null, ['class' => 'form-control', 'wire:model.defer' => 'password', 'placeholder' => 'Contraseña']) !!}
                    <span class="input-group-append">
                                <button type="button" wire:click="generarClave" class="btn btn-info btn-flat btn-sm text-sm">Generar!</button>
                            </span>
                    @error('password')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Role') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                    </div>
                    {{--{!! Form::select('role', $list_roles, null , ['class' => 'custom-select', 'wire:model.debounce.100000ms' => 'role', 'placeholder' => 'Seleccione']) !!}--}}
                    <select name="role" class="custom-select" wire:model.defer="role">
                        <option value="">Seleccione</option>
                        <option value="0">Estandar</option>
                        @foreach($list_roles as $rol)
                            <option value="{{ $rol->id }}">{{ ucwords($rol->nombre) }}</option>
                        @endforeach
                        @if(auth()->user()->role == 1 || auth()->user()->role ==100)
                            <option value="1">Administrador</option>
                        @endif
                    </select>

                    @error('role')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                    @enderror
                </div>
            </div>

            <div class="form-group text-right">
                <input type="submit" class="btn btn-block btn-success" value="Guardar">
            </div>

            {!! Form::close() !!}


        </div>
        <!-- /.card-body -->
        <div class="overlay-wrapper" wire:loading>
            <div class="overlay">
                <i class="fas fa-2x fa-sync-alt"></i>
            </div>
        </div>
    </div>

</div>
