<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Tiendas</h2>
                </div>
            </div>
            @if($listarTiendas)
                @foreach($listarTiendas as $key => $favorito)
                    <div class="col-lg-4 col-md-5">
                        <a href="@if($ruta == "android") {{ route('android.tienda', [auth()->id(), $favorito['id']]) }} @else {{ route('web.tienda', $favorito['id']) }} @endif" onclick="preSubmit()" class="latest-product__item">
                            <div class="latest-product__item__pic img-thumbnail">
                                <img src="{{ asset(verImg($favorito['miniatura'])) }}" alt="">
                            </div>
                            <div class="latest-product__item__text">
                                <h6>{{--{{ $favorito['nombre'] }}--}}</h6>
                                <span>{{--{{ $favorito['moneda'] }} --}}{{ $favorito['nombre'] }}</span>
                                {{--@if($favorito['estatus'] == 0)
                                    <small class="text-danger"><strong>Agotado.</strong></small>
                                @endif--}}
                            </div>
                        </a>
                    </div>
                @endforeach
                @else
                <div class="col-lg-12 col-md-5 text-center">
                    Aun no tienes tiendas marcadas como favorito.
                </div>
            @endif
        </div>
    </div>
</section>
