

@include('web.section_header')

@include('web.section_breadcrumb')

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                        <tr>
                            <th class="shoping__product">Productos</th>
                            {{--<th>Price</th>--}}
                            <th>Cantidad</th>
                            <th>Sub Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($listarCarrito as $carrito)
                            <tr id="tr_{{ $carrito->id }}">
                            <td class="shoping__cart__item">
                                <img src="{{ asset(verImg($carrito->stock->producto->cart)) }}" alt="">
                                <small class="label text-xs">{{ $carrito->stock->producto->nombre }}</small>
                                <p class="label text-xs">
                                    {{ $carrito->stock->empresa->moneda }} {{ $carrito->precio }}
                                </p>
                            </td>
                            <td class="shoping__cart__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" class="btn_editar_input"
                                               data-carrito-id="{{ $carrito->id }}"
                                               data-carrito-item="carrito_item_{{ $carrito->id }}"
                                               value="{{ formatoMillares($carrito->cantidad, 0) }}"
                                               id="valor_id_{{ $carrito->id }}"
                                        >
                                    </div>
                                </div>
                            </td>
                            <td class="shoping__cart__total" >
                                {{ $carrito->stock->empresa->moneda }}
                                <span id="carrito_item_{{ $carrito->id }}">
                                    {{ formatoMillares($carrito->item, 2) }}
                                </span>
                            </td>
                            <td class="shoping__cart__item__close">
                                <span class="icon_close btn_remover"
                                      data-id-carrito="{{ $carrito->id }}"
                                      data-item-carrito="tr_{{ $carrito->id }}"
                                ></span>
                            </td>
                        </tr>
                        @endforeach

                        {{--<tr>
                            <td class="shoping__cart__item">
                                <img src="{{ asset('storage/categorias/t_EuxpS4dNCDJcnax0qKT0oKYnylbRqd367yk6FcAf.png') }}" alt="">
                                <small class="label text-xs">Vegetable’s Package</small>
                                <p class="label text-xs">$69.00</p>
                            </td>
                            --}}{{--<td class="shoping__cart__price">
                                $55.00
                            </td>--}}{{--
                            <td class="shoping__cart__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                            </td>
                            <td class="shoping__cart__total">
                                $110,00
                            </td>
                            <td class="shoping__cart__item__close">
                                <span class="icon_close"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="shoping__cart__item">
                                <img src="{{ asset('vendor/ogani/img/cart/cart-2.jpg') }}" alt="">
                                <small class="label text-xs">Vegetable’s Package</small>
                                <p class="label text-xs">$69.00</p>
                            </td>
                            --}}{{--<td class="shoping__cart__price">
                                $39.00
                            </td>--}}{{--
                            <td class="shoping__cart__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                            </td>
                            <td class="shoping__cart__total">
                                $39.99
                            </td>
                            <td class="shoping__cart__item__close">
                                <span class="icon_close"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="shoping__cart__item">
                                <img src="{{ asset('vendor/ogani/img/cart/cart-3.jpg') }}" alt="">
                                <small class="label text-xs">Vegetable’s Package</small>
                                <p class="label text-xs">$69.00</p>
                            </td>
                            --}}{{--<td class="shoping__cart__price">
                                $69.00
                            </td>--}}{{--
                            <td class="shoping__cart__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                            </td>
                            <td class="shoping__cart__total">
                                $69.99
                            </td>
                            <td class="shoping__cart__item__close">
                                <span class="icon_close"></span>
                            </td>
                        </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @include('web.carrito.delivery')
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>
                            Subtotal
                            <span id="carrito_subtotal" data-cantidad="{{ $subtotal }}">
                                $ {{ formatoMillares($subtotal, 2) }}
                            </span>
                        </li>
                        <li>
                            I.V.A. ({{ calcularIVA(null, null, null, true) }}%)
                            <span id="carrito_iva" data-cantidad="{{ $iva }}">
                                $ {{ formatoMillares($iva, 2) }}
                            </span>
                        </li>
                        <li id="li_delivery" @if(is_null($delivery_zona)) class="d-none" @endif>
                            Delivery
                            <span id="carrito_delivery" data-cantidad="{{ $delivery_precio }}">
                            $ {{ formatoMillares($delivery_precio, 2) }}
                        </span>
                        </li>
                        <li>
                            Total
                            <span id="carrito_total" data-cantidad="{{ $total }}">
                                $ {{ formatoMillares($total, 2) }}
                            </span>
                        </li>
                    </ul>
                    <a href="#" class="primary-btn btn_procesar_carrito"
                       @if($listarCarrito->isNotEmpty())
                        data-estatus="lleno"
                        @else
                       data-estatus="vacio"
                        @endif id="btn_procesar_carrito">PROCESAR CARRITO</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

