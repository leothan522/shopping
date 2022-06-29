
<!-- Checkout Section Begin -->{{--
<section class="checkout spad">--}}
    <div class="container">
        {{--<div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                </h6>
            </div>
        </div>--}}
        <div class="checkout__form">
            {{--<h4>Detalles de Facturación</h4>--}}
            <form action="#">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-6">
                        @if($pedido->estatus == 0)
                            <span class="float-right text-warning">
                                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                        </span>
                        @endif
                        @if($pedido->estatus == 1)
                                <div class="alert alert-info">
                                    {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                                    <h5><i class="fa fa-money" aria-hidden="true"></i> Verificando Pago!</h5>
                                    Tu <strong>Metodo de Pago</strong> esta siendo verificado para proceder al despacho.
                                </div>
                        @endif
                        @if($pedido->estatus == 2)
                                <div class="alert alert-info">
                                    {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                                    <h5><i class="fa fa-truck" aria-hidden="true"></i> Pedido en ruta!</h5>
                                    <strong>Tu pedido esta en camino</strong>. Pendiente al telefono suministrado para concretar despacho.
                                </div>
                        @endif
                        @if($pedido->estatus == 3)
                                <div class="alert alert-success">
                                    {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                                    <h5><i class="fa fa-check text-success" aria-hidden="true"></i> Pedido Entregado!</h5>
                                    Tu pedido fue procesado completamente.
                                </div>
                        @endif
                        <div class="checkout__order">
                            <h4>Su Pedido <span class="float-right">{{ $pedido->numero }}</span></h4>
                            <div class="checkout__order__products">Productos <span>Total</span></div>
                            <ul>
                                @foreach($listarCarrito as $carrito)
                                    <li>
                                        {{ $carrito->stock->producto->nombre }}
                                        <small>(x{{ formatoMillares($carrito->cantidad, 0) }})</small>
                                        <span>${{ $carrito->total }}</span>
                                    </li>
                                @endforeach
                                {{--<li>Vegetable’s Package <small>(4)</small> <span>$75.99</span></li>
                                <li>Fresh Vegetable <small>(4)</small> <span>$151.99</span></li>
                                <li>Organic Bananas <small>(4.9)</small> <span>$53.99</span></li>--}}
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>${{ formatoMillares($pedido->subtotal, 2) }}</span></div>
                            <div class="checkout__order__total">I.V.A.(16%) <span class="text-dark">${{ formatoMillares($pedido->iva, 2) }}</span></div>
                            @if($pedido->delivery)
                            <div class="checkout__order__total">Delivery <span class="text-dark">${{ formatoMillares($pedido->delivery, 2) }}</span></div>
                            @endif
                            <div class="checkout__order__total">Total <span>${{ formatoMillares($pedido->total, 2) }}</span></div>
                            <div class="checkout__order__total">Bs. <span id="monto_bolivares" data-cantidad="{{ $pedido->bs }}">{{ formatoMillares($pedido->bs, 2) }} Bs.</span></div>
                            <div class="checkout__input__checkbox">
                                <label for="acc-or">
                                    Datos de Facturación
                                    {{--<span class="text-bold text-dark">hola</span>--}}
                                    {{--<input type="checkbox" id="acc-or">
                                    <span class="checkmark"></span>--}}
                                </label>
                            </div>
                            <div class="form-group">
                                {{--<label for="name">Cedula</label>--}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cedula</span>
                                    </div>
                                    <label class="form-control">{{ $pedido->cedula }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                {{--<label for="name">Cedula</label>--}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nombre</span>
                                    </div>
                                    <label class="form-control">{{ $pedido->nombre }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                {{--<label for="name">Cedula</label>--}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Telefono</span>
                                    </div>
                                    <label class="form-control">{{ $pedido->telefono }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dirección de envio</label>
                                <div class="input-group mb-3">
                                    <label class="form-control">{{ $pedido->direccion_1 }}</label>
                                </div>
                                @if($pedido->direccion_2)
                                <div class="input-group mb-3">
                                    <label class="form-control">{{ $pedido->direccion_2 }}</label>
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Metodo de Pago</label>
                                <div class="input-group mb-3">
                                    <label class="form-control">20025623</label>
                                </div>
                            </div>
                            @if($pedido->comprobante_pago)
                            <div class="form-group">
                                <label>Comprobante</label>
                                <div class="input-group mb-3">
                                    <label class="form-control">{{ $pedido->comprobante_pago }}</label>
                                </div>
                            </div>
                            @endif
                            {{--<button type="button" class="site-btn" data-id-pedido="{{ $pedido->id }}">I</button>--}}
                            <div class="col-md-12 text-center">
                                <a href="{{ route('web.home') }}" class="site-btn btn btn-primary">¡Seguir Comprando!</a>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>{{--
</section>--}}
<!-- Checkout Section End -->

