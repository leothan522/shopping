<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="hero__search">
                    <div class="hero__search__form">
                        {!! Form::open(['route' => 'busqueda.prueba', 'method' => 'post', 'onSubmit' => 'preSubmit()']) !!}
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
