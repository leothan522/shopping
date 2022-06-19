<form @if(!$empresa_id) wire:submit.prevent="store" @else wire:submit.prevent="update({{ $empresa_id }})" @endif >
<div class="row justify-content-center">

    {{--<div wire:loading>
        <div class="overlay">
            <i class="fas fa-2x fa-sync-alt"></i>
        </div>
    </div>--}}

    <div class="row col-md-12 justify-content-center">

        <div class="col-md-6">

            <div class="card card-outline card-purple">
                <div class="card-header">
                    <h5 class="card-title">Imagen</h5>
                    <div class="card-tools">
                        <span class="btn btn-tool"><i class="fas fa-image"></i></span>
                    </div>
                </div>
                <div class="card-body">


                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" wire:model="photo" class="custom-file-input" id="customFileLang" lang="es" accept="image/jpeg, image/png">
                        <label class="custom-file-label" for="customFileLang" data-browse="Elegir">Seleccionar Archivo</label>
                    </div>
                    @error('photo')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                    <i class="icon fas fa-exclamation-triangle"></i>
                    {{ $message }}
                </span>
                    @enderror
                </div>

                </div>
            </div>

            @if ($photo)

                Logo Preview:

                <img src="{{ $photo->temporaryUrl() }}" class="img-fluid img-thumbnail rounded mx-auto d-block">
                @else
                @if($logo)
                <img src="{{ asset($logo) }}" class="img-fluid img-thumbnail rounded mx-auto d-block">
                @endif
            @endif

            <div wire:loading wire:target="photo">Uploading...</div>

        </div>

        <div class="col-md-6">
            <div class="card card-outline card-purple">
                <div class="card-header">
                    <h5 class="card-title">Información</h5>
                    <div class="card-tools">
                        <span class="btn btn-tool"><i class="fas fa-book"></i></span>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="email">RIF</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model.defer="rif" placeholder="RIF de la Empresa">
                            @error('rif')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model.defer="nombre" placeholder="Nombre de la Empresa">
                            @error('nombre')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Moneda Base</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                            </div>
                            <select class="custom-select" wire:model.defer="moneda">
                                <option value="">Seleccione</option>
                                <option value="Bs.">Bolivares</option>
                                <option value="$">Dolares</option>
                            </select>
                            @error('moneda')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Telefonos</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model.defer="telefonos" placeholder="Telefonos">
                            @error('telefonos')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model.defer="email" placeholder="Email">
                            @error('email')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Dirección</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-directions"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model.defer="direccion" placeholder="Dirección">
                            @error('direccion')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group text-right">
                        @if($empresa_id)
                            <input type="submit" class="btn btn-block btn-primary" value="Guardar Cambios">
                            @else
                            <input type="submit" class="btn btn-block btn-success" value="Crear Empresa">
                        @endif


                    </div>



                </div>
            </div>
        </div>

    </div>
    @if($empresa_id)
    <div class="row mt-3 justify-content-end">
        <div class="col-md-12 float-right">
            <button type="button" class="btn btn-default btn-sm" wire:click="show({{ $empresa_id }})">Cerrar</button>
        </div>
    </div>
    @endif

</div>

</form>
