<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breakcubms.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{ $modulo }}</h2>
                    @if($titulo)
                    <div class="breadcrumb__option">
                        <span class="text-bold">{{ $titulo }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
