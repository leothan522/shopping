<section class="product spad">
    <div class="container">
        <div class="row">

                @foreach($listarProductos as $stock)

                    <div class="col-lg-3 col-md-5">
                        <a href="@if($ruta == 'android')
                                {{ route('android.detalles', $favorito['id']) }}
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
                                <span>${{ calcularPrecio($stock->id, $stock->pvp) }}</span>
                            </div>
                        </a>
                    </div>

                @endforeach

        </div>
    </div>
</section>
