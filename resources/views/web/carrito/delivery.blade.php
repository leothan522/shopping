<div class="col-lg-12">
    @if($listarCarrito->isNotEmpty())
    <div class="shoping__cart__btns" id="boton_incluir_del">
        <a href="#" data-accion="remover"
           class="primary-btn cart-btn btn-delivery" id="btn_delivery">
            NO INCLUIR DELIVERY
        </a>
    </div>
    @endif
</div>
<div class="col-lg-6" >
    <div class="shoping__continue" id="lista_zonas">
        @if($listarCarrito->isNotEmpty())
            <div class="shoping__discount">
            <h5>ZONA PARAE EL ENVIO</h5>
                <form action="#">
                    <select class="select-zonas" id="select_zo">
                    @if(!is_null($delivery_zona))
                            <option value="{{ $delivery_zona }}">{{ $delivery_nombre }}</option>
                            @else
                            <option value="vacia">Seleccione la zona para el envio</option>
                        @endif
                        @foreach($listarZonas as $zona)
                            @if($zona->id == $delivery_zona) @continue @endif
                            <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                        @endforeach
                    </select>
                </form>
        </div>
        @endif
    </div>
</div>
