<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Tiendas destacadas</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @php($item = null)
                        @foreach($listarDestacados as $stock)
                            @if($stock->empresa->categorias_id)
                                @if($item != $stock->empresa->categoria->nombre)
                                <li data-filter=".filter_{{ $stock->empresa->categorias_id }}">{{ $stock->empresa->categoria->nombre }}</li>
                                @php($item = $stock->empresa->categoria->nombre)
                                @endif
                            @endif
                        @endforeach
                        {{--<li data-filter=".oranges">Oranges</li>
                        <li data-filter=".fresh-meat">Fresh Meat</li>
                        <li data-filter=".vegetables">Vegetables</li>
                        <li data-filter=".fastfood">Fastfood</li>--}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @php($vistos = array())
            @foreach($listarDestacados as $stock)
                @if(!in_array($stock->empresas_id, $vistos))
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges filter_{{ $stock->empresa->categorias_id }}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg img-thumbnail" data-setbg="{{ asset(verImg($stock->empresa->miniatura)) }}">
                        @if(auth()->check())
                            <ul class="featured__item__pic__hover">
                            <li>
                                <a href="#" class="btn_favoritos @if($stock->favoritos) fondo-favoritos @endif" id="favoritos_{{ $stock->id }}"
                                   data-id-stock="{{ $stock->id }}" data-tipo="_tiendas">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="@if($ruta == "android") {{ route('android.tienda', [auth()->id(), $stock->empresas_id]) }} @else {{ route('web.tienda', $stock->empresas_id) }} @endif" onclick="preSubmit()">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </li>
                            {{--<li>
                                <a href="#" class="btn_carrito @if($stock->carrito) fondo-favoritos @endif" id="carrito_{{ $stock->id }}"
                                   data-id-stock="{{ $stock->id }}" data-cantidad="1" data-opcion="sumar">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </li>--}}
                        </ul>
                            @else
                            <ul class="featured__item__pic__hover">
                                <li><a href="{{ route('web.home') }}" onclick="preSubmit()"><i class="fa fa-heart"></i></a></li>
                                <li>
                                    <a href="@if($ruta == "android") {{ route('android.tienda', [auth()->id(), $stock->empresas_id]) }} @else {{ route('web.tienda', $stock->empresas_id) }} @endif" onclick="preSubmit()">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                                {{--<li><a href="{{ route('web.home') }}" onclick="preSubmit()"><i class="fa fa-shopping-cart"></i></a></li>--}}
                            </ul>
                        @endif
                    </div>
                    <div class="featured__item__text">
                        <h6>
                            <a href="@if($ruta == "android") {{ route('android.tienda', [auth()->id(), $stock->empresas_id]) }} @else {{ route('web.tienda', $stock->empresas_id) }} @endif">
                                {{ $stock->empresa->nombre }}
                            </a>
                        </h6>
                        {{--<h5>$--}}{{--{{ $stock->empresa->moneda }}--}}{{-- {{ calcularPrecio($stock->id, $stock->pvp) }}</h5>--}}
                    </div>
                </div>
            </div>
                @endif
                @php(array_push($vistos, $stock->empresas_id))
            @endforeach
            {{--<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('storage/categorias/t_kzZPmD0AQnOagpyYhWpDvIhKz9e4321wZejwyVuX.jpg') }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/featured/feature-2.jpg') }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/featured/feature-3.jpg') }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood oranges">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/featured/feature-4.jpg') }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/featured/feature-5.jpg') }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fastfood">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/featured/feature-6.jpg') }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/featured/feature-7.jpg') }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood vegetables">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('vendor/ogani/img/featured/feature-8.jpg') }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
</section>
<!-- Featured Section End -->
