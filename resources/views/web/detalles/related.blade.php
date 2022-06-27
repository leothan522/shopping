<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Producto Relacionado</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($listarRelacionados as $stock)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset(verImg($stock->producto->miniatura)) }}">
                        @if(auth()->check())
                            <ul class="product__item__pic__hover">
                            <li>
                                <a href="#" class="btn_favoritos @if($stock->favoritos) fondo-favoritos @endif" id="favoritos_{{ $stock->id }}"
                                   data-id-stock="{{ $stock->id }}" >
                                    <i class="fa fa-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="
                                @if($ruta == 'android')
                                {{ route('android.detalles', $stock->id) }}
                                @else
                                {{ route('web.detalles', $stock->id) }}
                                @endif" onclick="preSubmit()">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn_carrito @if($stock->carrito) fondo-favoritos @endif" id="carrito_{{ $stock->id }}"
                                   data-id-stock="{{ $stock->id }}" data-cantidad="1" data-opcion="sumar" >
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </li>
                        </ul>
                            @else
                            <ul class="product__item__pic__hover">
                                <li><a href="{{ route('web.detalles', $stock->id) }}" onclick="preSubmit()"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{ route('guest.detalles', $stock->id) }}" onclick="preSubmit()"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{ route('web.detalles', $stock->id) }}" onclick="preSubmit()"><i class="fa fa-shopping-cart"></i></a></li>
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

            {{--<div class="col-lg-3 col-md-4 col-sm-6">
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
            <div class="col-lg-3 col-md-4 col-sm-6">
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
            <div class="col-lg-3 col-md-4 col-sm-6">
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
            <div class="col-lg-3 col-md-4 col-sm-6">
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
            </div>--}}
        </div>
    </div>
</section>
<!-- Related Product Section End -->
