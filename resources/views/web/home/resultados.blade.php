<section class="product spad">
    <div class="container">
        <div class="row">
            {{--@if($listarFavoritos)
                @foreach($listarFavoritos as $key => $favorito)--}}
                    <div class="col-lg-4 col-md-5">
                        <a href="{{--@if($ruta == 'android')
                                {{ route('android.detalles', $favorito['id']) }}
                            @else
                                {{ route('web.detalles', $favorito['id']) }}
                            @endif--}}#" onclick="preSubmit()" class="latest-product__item">
                            <div class="latest-product__item__pic img-thumbnail">
                                <img src="{{ asset(verImg(null)) }}" alt="">
                            </div>
                            <div class="latest-product__item__text">
                                <h6>NOMBRE DE LA EMPRESA</h6>
                                <span>Nombre Stock</span>
                            </div>
                        </a>
                    </div>


            <div class="col-lg-4 col-md-5">
                <a href="{{--@if($ruta == 'android')
                                {{ route('android.detalles', $favorito['id']) }}
                            @else
                                {{ route('web.detalles', $favorito['id']) }}
                            @endif--}}#" onclick="preSubmit()" class="latest-product__item">
                    <div class="latest-product__item__pic img-thumbnail">
                        <img src="{{ asset(verImg(null)) }}" alt="">
                    </div>
                    <div class="latest-product__item__text">
                        <h6>NOMBRE DE LA EMPRESA</h6>
                        <span>Nombre Stock</span>
                    </div>
                </a>
            </div>


            <div class="col-lg-4 col-md-5">
                <a href="{{--@if($ruta == 'android')
                                {{ route('android.detalles', $favorito['id']) }}
                            @else
                                {{ route('web.detalles', $favorito['id']) }}
                            @endif--}}#" onclick="preSubmit()" class="latest-product__item">
                    <div class="latest-product__item__pic img-thumbnail">
                        <img src="{{ asset(verImg(null)) }}" alt="">
                    </div>
                    <div class="latest-product__item__text">
                        <h6>NOMBRE DE LA EMPRESA</h6>
                        <span>Nombre Stock</span>
                    </div>
                </a>
            </div>
                {{--@endforeach
            @endif--}}
        </div>
    </div>
</section>
