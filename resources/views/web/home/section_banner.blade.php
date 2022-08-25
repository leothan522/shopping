<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row justify-content-center">

            @foreach($listarBanner as $empresa)

                    <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                        <div class="banner__pic img-thumbnail">
                            <a href="@if($ruta == "android") {{ route('android.tienda', [auth()->id(), $empresa->id]) }} @else {{ route('web.tienda', $empresa->id) }} @endif">
                            <img src="{{ asset(verImg($empresa->miniatura)) }}" alt="">
                            </a>
                        </div>
                    </div>

            @endforeach

            {{--<div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                <div class="banner__pic">
                    <img src="{{ asset('vendor/ogani/img/banner/banner-1.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                <div class="banner__pic">
                    <img src="{{ asset('vendor/ogani/img/banner/banner-2.jpg') }}" alt="">
                </div>
            </div>--}}
        </div>
    </div>
</div>
<!-- Banner End -->
