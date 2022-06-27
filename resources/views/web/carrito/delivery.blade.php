<div class="col-lg-12">
    <div class="shoping__cart__btns">
        <a href="#" data-accion="remover"
           class="primary-btn cart-btn btn-delivery" id="btn_delivery">
            NO INCLUIR DELIVERY
        </a>
    </div>
</div>
<div class="col-lg-6" >
    <div class="shoping__continue" id="lista_zonas">
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
    </div>
</div>
