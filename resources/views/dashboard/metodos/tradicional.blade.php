<div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
    <div class="card-header">
        <h3 class="card-title">

            Tradicional

        </h3>
        <div class="card-tools">
            {{--@if(leerJson(Auth::user()->permisos, 'almacen.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-lg-almacen" wire:click="limpiar">
                    <i class="fas fa-plus-square"></i>
                </button>
            @endif--}}

            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <ul class="list-group text-sm">
            <li class="list-group-item fondo">
                <span>Efectivo BS.</span>
                @if(leerJson(Auth::user()->permisos, 'metodos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                        <input type="checkbox" wire:click="parametro('efectivo_bs')"
                               @if($efectivo_bs) checked @endif
                        class="custom-control-input" id="customSwitchBs">
                        <label class="custom-control-label" for="customSwitchBs"></label>
                    </div>
                    @else
                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                        <input type="checkbox" @if($efectivo_bs) checked @endif disabled
                               class="custom-control-input" id="customSwitchBs">
                        <label class="custom-control-label" for="customSwitchBs"></label>
                    </div>
                @endif
            </li>
            <li class="list-group-item fondo">
                <span>Efectivo Dolares</span>
                @if(leerJson(Auth::user()->permisos, 'metodos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                        <input type="checkbox" wire:click="parametro('efectivo_dolares')"
                                      @if($efectivo_dolares) checked @endif
                        class="custom-control-input" id="customSwitchDo">
                        <label class="custom-control-label" for="customSwitchDo"></label>
                    </div>
                    @else
                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                        <input type="checkbox" disabled
                               @if($efectivo_dolares) checked @endif
                               class="custom-control-input" id="customSwitchDo">
                        <label class="custom-control-label" for="customSwitchDo"></label>
                    </div>
                @endif
            </li>
            <li class="list-group-item fondo">
                <span>Tarjeta de Debito</span>
                @if(leerJson(Auth::user()->permisos, 'metodos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                        <input type="checkbox" wire:click="parametro('debito')"
                               @if($debito) checked @endif
                        class="custom-control-input" id="customSwitchDe">
                        <label class="custom-control-label" for="customSwitchDe"></label>
                    </div>
                    @else
                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                        <input type="checkbox" disabled
                               @if($debito) checked @endif
                               class="custom-control-input" id="customSwitchDe">
                        <label class="custom-control-label" for="customSwitchDe"></label>
                    </div>
                @endif
            </li>

        </ul>

    </div>
    <!-- /.card-body -->
</div>
