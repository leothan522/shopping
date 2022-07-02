<section class="product spad">
    <div class="container">
        <div class="row">
            @if($listarFavoritos)
                @foreach($listarFavoritos as $key => $favorito)
                    <div class="col-lg-3 col-md-5">
                        <a href="@if($ruta == 'android')
                                {{ route('android.detalles', $favorito['id']) }}
                            @else
                                {{ route('web.detalles', $favorito['id']) }}
                            @endif" onclick="preSubmit()" class="latest-product__item">
                            <div class="latest-product__item__pic img-thumbnail">
                                <img src="{{ asset(verImg($favorito['miniatura'])) }}" alt="">
                            </div>
                            <div class="latest-product__item__text">
                                <h6>{{ $favorito['nombre'] }}</h6>
                                <span>{{ $favorito['moneda'] }} {{ calcularPrecio($favorito['producto_id'], $favorito['pvp']) }}</span>
                                @if($favorito['estatus'] == 0)
                                    <small class="text-danger"><strong>Agotado.</strong></small>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
