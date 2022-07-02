<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            @if($listarUltimos->count() >= 4)
                                @include('web.categorias.section_latest')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">

                {{--@include('web.categorias.section_discount')--}}

                <div class="filter__item">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{ $cantidad }}</span> Productos Disponibles</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @include('web.categorias.section_items')

            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
