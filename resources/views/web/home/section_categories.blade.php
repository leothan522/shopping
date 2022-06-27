<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach($listarCategorias as $categoria)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg img-thumbnail" data-setbg="{{ asset(verImg($categoria->imagen)) }}">
                            <h5>
                                <a onclick="preSubmit()" href="@if($ruta == "android")
                                    {{ route('android.categorias', $categoria->id) }}
                                    @else
                                    @if(auth()->check())
                                        {{ route('web.categorias', $categoria->id) }}
                                        @else
                                        {{ route('guest.categorias', $categoria->id) }}
                                    @endif
                                @endif">{{ $categoria->nombre }}</a>
                            </h5>
                        </div>
                    </div>
                @endforeach
                {{--<div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ asset('vendor/ogani/img/categories/cat-1.jpg') }}">
                        <h5><a href="#">Fresh Fruit</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ asset('vendor/ogani/img/categories/cat-2.jpg') }}">
                        <h5><a href="#">Dried Fruit</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ asset('vendor/ogani/img/categories/cat-3.jpg') }}">
                        <h5><a href="#">Vegetables</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ asset('vendor/ogani/img/categories/cat-4.jpg') }}">
                        <h5><a href="#">drink fruits</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ asset('vendor/ogani/img/categories/cat-5.jpg') }}">
                        <h5><a href="#">drink fruits</a></h5>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->
