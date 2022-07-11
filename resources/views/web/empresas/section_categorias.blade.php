<section class="product spad">
    <div class="container">
        <div class="row">
            @if($listarTiendas)
                @foreach($listarTiendas as $empresa)
                    <div class="col-lg-3 col-md-5">
                        <a href="@if($ruta == 'android')
                                {{ route('android.tienda', [auth()->id(), $empresa->id]) }}
                            @else
                                {{ route('web.tienda', $empresa->id) }}
                            @endif" onclick="preSubmit()" class="latest-product__item">
                            <div class="latest-product__item__pic img-thumbnail">
                                <img src="{{ asset(verImg($empresa->miniatura)) }}" alt="">
                            </div>
                            <div class="latest-product__item__text">
                                <h6>&nbsp;</h6>
                                <span>{{ $empresa->nombre }}</span>
                                {{--<span>{{ $favorito['moneda'] }} {{ calcularPrecio($favorito['producto_id'], $favorito['pvp']) }}</span>
                                @if($favorito['estatus'] == 0)
                                    <small class="text-danger"><strong>Agotado.</strong></small>
                                @endif--}}
                            </div>
                        </a>
                    </div>
                @endforeach
                @else
                <div class="col-lg-12 col-md-5 text-center">
                    Aun no tenemos Tiendas registradas.
                </div>
            @endif
        </div>
    </div>
</section>
