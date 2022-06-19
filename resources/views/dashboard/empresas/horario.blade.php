

<div class="row col-md-12 justify-content-center">

    <div class="col-md-6">

        <div class="card card-outline card-purple">
            <div class="card-header">
                <h5 class="card-title">Horario de la Tienda</h5>
                <div class="card-tools">
                    {{--<span class="btn btn-tool"><i class="fas fa-list"></i></span>--}}
                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                        <input type="checkbox" @if($horario) checked @endif wire:click="botonHorario({{ $horario_id }})" class="custom-control-input" id="customSwitchHours">
                        <label class="custom-control-label" for="customSwitchHours"></label>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <h3 class="profile-username text-center">{{ $nombre }}</h3>
                <div class="form-group">
                    <label>Dias Activos</label>
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" @if($lunes) checked @endif wire:click="diasActivos('Mon', {{ $lunes }})">
                        </span>
                    </div>
                    <label class="form-control">Lunes</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" @if($martes) checked @endif wire:click="diasActivos('Tue', {{ $martes }})">
                        </span>
                    </div>
                    <label class="form-control">Martes</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" @if($miercoles) checked @endif wire:click="diasActivos('Wed', {{ $miercoles }})">
                        </span>
                    </div>
                    <label class="form-control">Miercoles</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" @if($jueves) checked @endif wire:click="diasActivos('Thu', {{ $jueves }})">
                        </span>
                    </div>
                    <label class="form-control">Jueves</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" @if($viernes) checked @endif wire:click="diasActivos('Fri', {{ $viernes }})">
                        </span>
                    </div>
                    <label class="form-control">Viernes</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" @if($sabado) checked @endif wire:click="diasActivos('Sat', {{ $sabado }})">
                        </span>
                    </div>
                    <label class="form-control">Sabado</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" @if($domingo) checked @endif wire:click="diasActivos('Sun', {{ $domingo }})">
                        </span>
                    </div>
                    <label class="form-control">Domingo</label>
                </div>



            </div>
        </div>

    </div>


    <div class="col-md-6">


        <div class="card card-outline card-purple">
            <div class="card-header">
                <h5 class="card-title">Rango Horas</h5>
                <div class="card-tools">
                    <span class="btn btn-tool"><i class="fas fa-clock"></i></span>
                </div>
            </div>
            <div class="card-body">

                <form wire:submit.prevent="storeHoras">

                <div class="form-group">
                    <label for="email">Apertura</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        </div>
                        <input type="time" wire:model="apertura">
                        @error('apertura')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Cierre</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        </div>
                        <input type="time" wire:model="cierre">
                        @error('cierre')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group text-right">
                    <input type="submit" class="btn btn-block btn-primary" value="Guardar Horas">
                </div>

                </form>


            </div>
        </div>


        @if(estatusTienda($empresa_id))
            <div class="alert alert-success">
                <h5><i class="icon fas fa-check"></i> ¡Abierto!</h5>
                Hora actual: <strong>{{ date('h:i a') }}</strong>. Estatus: <strong> OPEN </strong>
            </div>
        @else
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> ¡Cerrado!</h5>
                Hora actual: <strong>{{ date('h:i a') }}</strong>. Estatus: <strong> CLOSED </strong>
            </div>
        @endif


    </div>

    <div class="row mt-3 justify-content-end">
        <div class="col-md-12 float-right">
            <button type="button" class="btn btn-default btn-sm" wire:click="show({{ $empresa_id }})">Cerrar</button>
        </div>
    </div>

</div>


