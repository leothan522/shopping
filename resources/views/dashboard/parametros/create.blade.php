<div class="col-md-3">
    <div class="card card-gray-dark" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
        <div class="card-header">
            <h3 class="card-title">Crear Parametro</h3>
            <div class="card-tools">
                {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>--}}
                <span class="btn btn-tool"><i class="fas fa-list"></i></span>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form wire:submit.prevent="store">

                <div class="form-group">
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
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-bold">tabla_id{{--<i class="fas fa-code"></i>--}}</span>
                        </div>
                        <input type="text" class="form-control" wire:model.defer="tabla_id" name="tabla_id" placeholder="[integer]">
                        @error('tabla_id')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-bold">valor{{--<i class="fas fa-code"></i>--}}</span>
                        </div>
                        <input type="text" class="form-control" wire:model.defer="valor" name="valor" placeholder="[string]">
                        @error('valor')
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

            </form>
        </div>
        <!-- /.card-body -->
        <div class="overlay-wrapper" wire:loading>
            <div class="overlay">
                <i class="fas fa-2x fa-sync-alt"></i>
            </div>
        </div>
    </div>

</div>
