<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="hero__search">
                    <div class="hero__search__form">

                        @if($ruta == 'android')
                            {!! Form::open(['route' => ['android.home', auth()->id()], 'method' => 'get', 'onSubmit' => 'preSubmit()']) !!}
                        @else
                            {!! Form::open(['route' => ['web.home'], 'method' => 'get', 'onSubmit' => 'preSubmit()']) !!}
                        @endif
                            <input type="text" placeholder="¿Que necesitas?" required>
                            <button type="submit" class="site-btn">BUSCAR</button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
