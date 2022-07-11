<section class="product spad">
    <div class="container">
        <div class="row">
            @if($listarProductos->isNotEmpty())

                @foreach($listarProductos as $producto)
                    @foreach($producto->stock as $stock)

                        <div class="col-lg-4 col-md-5">
                            <a href="@if($ruta == 'android')
                            {{ route('android.detalles', [auth()->id(), $stock->id]) }}
                            @else
                            {{ route('web.tienda', $stock->empresas_id) }}
                            @endif" onclick="preSubmit()" class="latest-product__item">
                                <div class="latest-product__item__pic img-thumbnail">
                                    <img src="{{ asset(verImg($stock->empresa->miniatura)) }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $stock->empresa->nombre }}</h6>
                                    <span>{{ $stock->producto->nombre }}</span>
                                    @if($stock->estatus == 0 || $stock->stock_disponible <= 0)
                                        <small class="text-danger"><strong>Agotado.</strong></small>
                                    @endif
                                </div>
                            </a>
                        </div>

                    @endforeach
                @endforeach

                @else
                <div class="col-lg-12 col-md-5 text-center">
                    Sin resultados para la busqueda &nbsp; <strong class="text-bold"> { <span class="text-danger">{{ $titulo }}</span> }</strong>
                </div>
            @endif
        </div>
    </div>
</section>
