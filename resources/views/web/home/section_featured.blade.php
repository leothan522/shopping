<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Producto destacado</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @php($item = null)
                        @foreach($listarDestacados as $stock)
                            @if($item != $stock->producto->categoria->nombre)
                                <li data-filter=".filter_{{ $stock->producto->categorias_id }}">{{ $stock->producto->categoria->nombre }}</li>
                                @php($item = $stock->producto->categoria->nombre)
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

            @foreach($listarDestacados as $stock)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges filter_{{ $stock->producto->categorias_id }}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg img-thumbnail" data-setbg="{{ asset(verImg($stock->producto->miniatura)) }}">
                        <ul class="featured__item__pic__hover">
                            <li>
                                <a href="#" class="btn_favoritos @if($stock->favoritos) fondo-favoritos @endif" id="favoritos_{{ $stock->id }}"
                                   data-id-stock="{{ $stock->id }}" >
                                    <i class="fa fa-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('shop.detalles', $stock->id) }}" onclick="preSubmit()">
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
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">{{ $stock->producto->nombre }}</a></h6>
                        <h5>{{ $stock->empresa->moneda }} {{ calcularIVA($stock->productos_id, $stock->pvp) }}</h5>
                    </div>
                </div>
            </div>
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
