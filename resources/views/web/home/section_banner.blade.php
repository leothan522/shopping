<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row justify-content-center">

            @foreach($listarBanner as $empresa)

                    <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                        <div class="banner__pic img-thumbnail">
                            <a href="@if($ruta == "android") # @else {{ route('web.tienda', $empresa->id) }} @endif">
                            <img src="{{ asset(verImg($empresa->banner)) }}" alt="">
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
