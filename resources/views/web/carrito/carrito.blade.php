

@include('web.section_header')

@include('web.carrito.section_breadcrumb')

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
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="shoping__cart__item">
                                <img src="{{ asset('storage/categorias/t_EuxpS4dNCDJcnax0qKT0oKYnylbRqd367yk6FcAf.png') }}" alt="">
                                <small class="label text-xs">Vegetable’s Package</small>
                                <p class="label text-xs">$69.00</p>
                            </td>
                            {{--<td class="shoping__cart__price">
                                $55.00
                            </td>--}}
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
                            {{--<td class="shoping__cart__price">
                                $39.00
                            </td>--}}
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
                            {{--<td class="shoping__cart__price">
                                $69.00
                            </td>--}}
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
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>$454.98</span></li>
                        <li>Total <span>$454.98</span></li>
                    </ul>
                    <a href="#" class="primary-btn">FINALIZAR COMPRA</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

