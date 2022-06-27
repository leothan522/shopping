<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                             src="{{ asset(verImg($stock->producto->detail)) }}" alt="">
                    </div>
                    {{--<div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="{{ asset('vendor/ogani/img/product/details/product-details-2.jpg') }}"
                             src="{{ asset('vendor/ogani/img/product/details/thumb-1.jpg') }}" alt="">
                        <img data-imgbigurl="{{ asset('vendor/ogani/img/product/details/product-details-3.jpg') }}"
                             src="{{ asset('vendor/ogani/img/product/details/thumb-2.jpg') }}" alt="">
                        <img data-imgbigurl="{{ asset('vendor/ogani/img/product/details/product-details-5.jpg') }}"
                             src="{{ asset('vendor/ogani/img/product/details/thumb-3.jpg') }}" alt="">
                        <img data-imgbigurl="{{ asset('vendor/ogani/img/product/details/product-details-4.jpg') }}"
                             src="{{ asset('vendor/ogani/img/product/details/thumb-4.jpg') }}" alt="">
                    </div>--}}
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $stock->producto->nombre }}</h3>
                    <div class="product__details__rating">
                        {{--<i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>--}}
                    </div>
                    <div class="product__details__price">${{--{{ $stock->empresa->moneda }}--}} {{ calcularPrecio($stock->id, $stock->pvp) }}</div>
                    @if(!empty($stock->descripcion))
                        <p class="text-justify">{{ $stock->producto->descripcion }}</p>
                    @endif
                    <p class="text-bold">
                        <a href="
                        @if($ruta == 'android')
                        {{ route('android.carrito', auth()->id()) }}
                        @else
                        {{ route('web.carrito') }}
                        @endif" class="text-muted text-bold">
                            <i class="fa fa-shopping-cart"></i> <span id="cart_actual">{{ $cantCarrito }}</span>
                        </a>
                        </p>
                    @if(auth()->check())
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" id="cantAgregar">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn btn_carrito @if($stock->carrito) fondo-favoritos @endif"
                           data-id-stock="{{ $stock->id }}" data-cantidad="1" data-opcion="agregar" >
                            Agregar
                        </a>
                        <a href="#" class="heart-icon btn_favoritos @if($stock->favoritos) fondo-favoritos @endif"
                       id="favoritos_{{ $stock->id }}" data-id-stock="{{ $stock->id }}">
                        <span class="icon_heart_alt"></span>
                    </a>
                        @else
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('web.detalles', $stock->id)  }}" onclick="preSubmit()" class="primary-btn">Agregar</a>
                        <a href="{{ route('web.detalles', $stock->id)  }}" onclick="preSubmit()" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    @endif
                    <ul>
                        <li><b>Categoria:</b> <span> {{ $stock->producto->categoria->nombre }}</span></li>
                        @if(!empty($stock->marca))
                            <li><b>Marca:</b> <span>{{ $stock->marca }}</span></li>
                        @endif
                        @if(!empty($stock->modelo))
                            <li><b>Modelo:</b> <span>{{ $stock->marca }}</span></li>
                        @endif
                         @if(!empty($stock->unidad))
                            <li><b>Unidad:</b> <span>{{ $stock->marca }}</span></li>
                        @endif


                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
