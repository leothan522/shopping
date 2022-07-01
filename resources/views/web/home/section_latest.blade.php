<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Últimos Productos</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php($i = 1)
                        @foreach($listarUltimos as $stock)
                            @if($i == 1)
                                <div class="latest-prdouct__slider__item">
                            @endif
                                <a href="
                                @if($ruta == 'android')
                                {{ route('android.detalles', $stock->id) }}
                                @else
                                    @if(auth()->check())
                                        {{ route('web.detalles', $stock->id) }}
                                        @else
                                        {{ route('guest.detalles', $stock->id) }}
                                    @endif
                                @endif"
                                   onclick="preSubmit()" class="latest-product__item">
                                    <div class="latest-product__item__pic img-thumbnail">
                                        <img src="{{ asset(verImg($stock->producto->miniatura)) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $stock->producto->nombre }}</h6>
                                        <span>${{--{{ $stock->empresa->moneda }}--}} {{ calcularPrecio($stock->id, $stock->pvp) }}</span>
                                    </div>
                                </a>
                            @if($i == 3)
                                </div>
                                @php($i = 0)
                            @endif
                            @php($i++)
                        @endforeach
                        @if($listarUltimos->count() <= 3) </div> @endif
                        @if($listarUltimos->count() <= 6) </div> @endif
                        {{--<div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('storage/categorias/t_kzZPmD0AQnOagpyYhWpDvIhKz9e4321wZejwyVuX.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Primeros Productos</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php($i = 1)
                        @foreach($listarPrimeros as $stock)
                            @if($i == 1)
                                <div class="latest-prdouct__slider__item">
                                    @endif
                                    <a href="
                                    @if($ruta == 'android')
                                    {{ route('android.detalles', $stock->id) }}
                                    @else
                                        @if(auth()->check())
                                        {{ route('web.detalles', $stock->id) }}
                                        @else
                                        {{ route('guest.detalles', $stock->id) }}
                                        @endif
                                    @endif" onclick="preSubmit()" class="latest-product__item">
                                        <div class="latest-product__item__pic img-thumbnail">
                                            <img src="{{ asset(verImg($stock->producto->miniatura)) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $stock->producto->nombre }}</h6>
                                            <span>${{--{{ $stock->empresa->moneda }}--}} {{ calcularPrecio($stock->id, $stock->pvp) }}</span>
                                        </div>
                                    </a>
                                    @if($i == 3)
                                </div>
                                @php($i = 0)
                            @endif
                            @php($i++)
                        @endforeach
                        @if($listarUltimos->count() < 6) </div> @endif
                        {{--<div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Revisar Productos</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php($i = 1)
                        @foreach($listarRevisar as $stock)
                            @if($i == 1)
                                <div class="latest-prdouct__slider__item">
                                    @endif
                                    <a href="
                                    @if($ruta == 'android')
                                    {{ route('android.detalles', $stock->id) }}
                                    @else
                                        @if(auth()->check())
                                        {{ route('web.detalles', $stock->id) }}
                                        @else
                                        {{ route('guest.detalles', $stock->id) }}
                                        @endif
                                    @endif" onclick="preSubmit()" class="latest-product__item">
                                        <div class="latest-product__item__pic img-thumbnail">
                                            <img src="{{ asset(verImg($stock->producto->miniatura)) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $stock->producto->nombre }}</h6>
                                            <span>${{--{{ $stock->empresa->moneda }}--}} {{ calcularPrecio($stock->id, $stock->pvp) }}</span>
                                </div>
                                    </a>
                                    @if($i == 3)
                                </div>
                                @php($i = 0)
                            @endif
                            @php($i++)
                        @endforeach
                        @if($listarUltimos->count() < 6) </div> @endif
                        {{--<div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-1.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-2.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('vendor/ogani/img/latest-product/lp-3.jpg') }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>Crab Pool Security</h6>
                                    <span>$30.00</span>
                                </div>
                            </a>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->
