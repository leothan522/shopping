
@include('web.section_header')
@include('web.section_breadcrumb')

<!-- Checkout Section Begin -->
<section class="checkout spad">
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
                    {{--<div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" class="checkout__input__add">
                            <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Country/State<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="acc">
                                Create an account?
                                <input type="checkbox" id="acc">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <p>Create an account by entering the information below. If you are a returning customer
                            please login at the top of the page</p>
                        <div class="checkout__input">
                            <p>Account Password<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="diff-acc">
                                Ship to a different address?
                                <input type="checkbox" id="diff-acc">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input">
                            <p>Order notes<span>*</span></p>
                            <input type="text"
                                   placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>--}}
                    <div class="col-lg-7 col-md-6">
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
                            <div class="checkout__order__total">I.V.A.({{ calcularIVA(null, null, null, true) }}%) <span class="text-dark">${{ formatoMillares($pedido->iva, 2) }}</span></div>
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
                                    <input type="text" class="form-control" value="{{ $pedido->cedula }}" @if($pedido->cedula) data-opcion="{{ $pedido->cliente_id }}" @else data-opcion="vacio" @endif id="checkout_cedula" placeholder="Ingrese cedula">
                                    <span class="col-sm-12 text-sm text-bold text-danger d-none" id="alert_cedula">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        El campo cedula es obligatorio.
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                {{--<label for="name">Cedula</label>--}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nombre</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $pedido->nombre }}" id="checkout_nombre" placeholder="Ingrese nombre">
                                    <span class="col-sm-12 text-sm text-bold text-danger d-none" id="alert_nombre">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        El campo nombre es obligatorio.
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                {{--<label for="name">Cedula</label>--}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Telefono</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $pedido->telefono }}" id="checkout_telefono" placeholder="Ingrese telefono">
                                    <span class="col-sm-12 text-sm text-bold text-danger d-none" id="alert_telefono">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        El campo telefono es obligatorio.
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dirección de envio</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ $pedido->direccion_1 }}" placeholder="Número de la casa y nombre de la calle" id="checkout_direccion_1">
                                    <span class="col-sm-12 text-sm text-bold text-danger d-none" id="alert_direccion_1">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        El campo direccion es obligatorio.
                                    </span>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ $pedido->direccion_2 }}" placeholder="Apartamento, habitación, etc. (opcional)" id="checkout_direccion_2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Metodo de Pago</label>
                                <div class="input-group mb-3">
                                    <select id="checkout_metodo">
                                        @if(!$pedido->metodo_pago)
                                            <option value="">Seleccione Metodo</option>
                                            @else
                                            <option value="{{ $pedido->metodo_pago }}">{{ $pedido->revisar }}</option>
                                        @endif
                                    @foreach($listarMetodos as $parametro)
                                            <option value="{{ $parametro->id }}">{{ $parametro->metodo }}</option>
                                    @endforeach
                                    </select>
                                    <span class="col-sm-12 text-sm text-bold text-danger d-none" id="alert_metodo">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        El campo Metodo es obligatorio.
                                    </span>
                                </div>
                            </div>
                            <div class="row justify-content-center" id="checkout_label_cuentas">

                                {{--<p class="text-center col-md-6">
                                    Banco: <strong class="text-bold text-dark text-xl-center">Venezuela</strong><br>
                                    # <strong class="text-bold text-dark text-xl-center">Venezuela</strong> <br>
                                    Cuenta: <strong class="text-bold text-dark text-xl-center">Corriente</strong><br>
                                    Titular: <strong class="text-bold text-dark text-xl-center">Corriente</strong><br>
                                    Rif: <strong class="text-bold text-dark text-xl-center">Corriente</strong><br>
                                </p>--}}

                            </div>
                            <div class="form-group @if(!$pedido->metodo_pago) d-none @endif" id="div_comprobante">
                                <label>Comprobante</label>
                                @if($pedido->metodo_pago)
                                <div class="input-group">
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            Su comprobante NO aparece en nuestro Libro Banco. Verifique!
                                    </span>
                                </div>
                                @endif
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ $pedido->comprobante_pago }}" placeholder="Número de referencia" id="checkout_comprobante" data-requerido="no">
                                    <span class="col-sm-12 text-sm text-bold text-danger d-none" id="alert_comprobante">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        El campo comprobante es obligatorio.
                                    </span>
                                </div>
                            </div>
                            <button type="button" class="site-btn" id="btn_procesar_pedido" data-id-pedido="{{ $pedido->id }}">PROCESAR PEDIDO</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

