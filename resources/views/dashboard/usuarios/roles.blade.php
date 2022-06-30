<div class="row mb-2 ml-1 mt-md-3 mb-3">
    <div class="col-sm-6">
        <h3 class="m-0 text-dark">Roles de Usuarios</h3>
    </div><!-- /.col -->
</div>

<div class="row justify-content-center">

    <div class="col-md-3">


        <div class="card card-gray-dark" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
            <div class="card-header">
                <h3 class="card-title">Opciones</h3>
                <div class="card-tools">
                    {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>--}}
                    <span class="btn btn-tool"><i class="fas fa-list"></i></span>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                @if(!$roles_usuarios->isEmpty())
                <div class="form-group">
                    <label for="exampleInputEmail1">Seleccionar {{ __('Role') }}:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                        </div>
                        {!! Form::select('roles', $roles_usuarios, null , ['class' => 'custom-select', 'wire:model' => 'roles', 'placeholder' => 'Seleccione']) !!}
                        {{--@error('roles')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                        @enderror--}}
                    </div>
                </div>
                @endif
                @if($roles == null)
                <form wire:submit.prevent="store">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Crear uno Nuevo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-bold">nombre{{--<i class="fas fa-code"></i>--}}</span>
                            </div>
                            <input type="text" class="form-control" wire:model.defer="nombre" name="nombre" placeholder="[string]">
                            @error('nombre')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group text-right">
                        <input type="submit" class="btn btn-block btn-success" value="Crear {{ __('Role') }}">
                    </div>

                </form>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="overlay-wrapper" wire:loading>
                <div class="overlay">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div>
            </div>
        </div>


    </div>
    <div class="col-md-9">

        <div class="card card-outline card-purple">
            <div class="card-header">
                <h3 class="card-title">Permisos de Usuario @if($rol_id) del {{ __('Role') }} <strong>{{ ucwords($nombre) }} </strong> @endif </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                @if($rol_id != null)
                <div class="row">
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.usuarios')
                    </div>
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.empresas')
                    </div>
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.delivery')
                    </div>
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.categorias')
                    </div>
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.productos')
                    </div>
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.almacen')
                    </div>
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.metodos')
                    </div>
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.stock')
                    </div>
                    <div class="col-md-4">
                        @include('dashboard.usuarios.roles.pedidos')
                    </div>
                </div>
                    @else
                    Seleccione un Rol ó cree uno nuevo.
                @endif


                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-danger @if($rol_id == null || $ocultar_boton) d-none @endif" wire:click="destroy({{ $rol_id }})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-primary @if($rol_id == null) d-none @endif" wire:click="actualRol()">
                                {{--<i class="fas fa-level-up"></i>--}} Actualizar Usuarios
                            </button>
                            <button type="button" class="btn btn-default @if($rol_id == null) d-none @endif" wire:click="limpiar()">
                                {{--<i class="fas fa-long-arrow-left"></i> --}}Cerrar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
        </div>


    </div>

</div>
