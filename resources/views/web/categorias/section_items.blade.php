<div class="row">
    @foreach($listarProductos as $producto)
        @foreach($producto->stock as $stock)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset(verImg($stock->producto->miniatura)) }}">
                        @if(auth()->check())
                            <ul class="product__item__pic__hover">
                            <li>
                                <a href="#" class="btn_favoritos @if($stock->favoritos) fondo-favoritos @endif" id="favoritos_{{ $stock->id }}"
                                   data-id-stock="{{ $stock->id }}" data-tipo="_productos" >
                                    <i class="fa fa-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="
                            @if($ruta == 'android')
                                {{ route('android.detalles', [auth()->id(), $stock->id]) }}
                                @else
                                {{ route('web.detalles', $stock->id) }}
                                @endif" onclick="preSubmit()">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn_carrito @if($stock->carrito) fondo-favoritos @endif" id="carrito_{{ $stock->id }}"
                                   data-id-stock="{{ $stock->id }}" data-cantidad="1" data-opcion="sumar">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </li>
                        </ul>
                            @else
                            <ul class="product__item__pic__hover">
                                <li><a href="{{ route('web.categorias', $stock->producto->categorias_id) }}" onclick="preSubmit()"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{ route('guest.detalles', $stock->id) }}" onclick="preSubmit()"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{ route('web.categorias', $stock->producto->categorias_id) }}" onclick="preSubmit()"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        @endif
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">{{ $stock->producto->nombre }}</a></h6>
                        <h5>${{--{{ $stock->empresa->moneda }}--}} {{ calcularPrecio($stock->id, $stock->pvp) }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
    {{--<div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/categorias/t_kzZPmD0AQnOagpyYhWpDvIhKz9e4321wZejwyVuX.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-2.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-3.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-4.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-5.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-6.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-7.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-8.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-9.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-10.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-11.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/product/product-1.jpg') }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">Crab Pool Security</a></h6>
                <h5>$30.00</h5>
            </div>
        </div>
    </div>--}}
</div>
<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row justify-content-center">
    @php($vistos = array())
    @foreach($listarProductos as $producto)
        @foreach($producto->stock as $stock)
            @if(!in_array($stock->empresas_id, $vistos))
                <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                    <div class="banner__pic img-thumbnail">
                        <a href="@if($ruta == "android") # @else {{ route('web.tienda', $stock->empresas_id) }} @endif">
                            <img src="{{ asset(verImg($stock->empresa->banner, true)) }}" alt="">
                        </a>
                    </div>
                </div>
            @endif
                @php(array_push($vistos, $stock->empresas_id))
        @endforeach
    @endforeach
        </div>
    </div>
</div>
<!-- Banner End -->

