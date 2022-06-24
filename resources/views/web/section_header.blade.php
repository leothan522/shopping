<!-- Header Section Begin -->
<header class="header">
    <div class="header__top"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="{{ asset('img/logo_letras.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu"></nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li>
                            <a href="#" class="btn_favoritos" content="1">
                                <i class="fa fa-heart"></i> <span id="header_favoritos">1</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn_carrito" content="2">
                                <i class="fa fa-shopping-bag"></i> <span id="header_carrito">3</span>
                            </a>
                        </li>
                    </ul>
                    <div class="header__cart__price">
                        item: <span id="header_item">$150.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->
