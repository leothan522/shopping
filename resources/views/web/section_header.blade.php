<!-- Header Section Begin -->
<header class="header">
    <div class="header__top"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('shop.home', auth()->id()) }}"><img src="{{ asset('img/logo_letras.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu"></nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-heart"></i> <span id="header_favoritos">{{ $headerFavoritos }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shop.carrito', auth()->id()) }}">
                                <i class="fa fa-shopping-bag"></i> <span id="header_carrito">{{ formatoMillares($headerItems, 0) }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="header__cart__price">
                        item: <span id="header_item">${{ formatoMillares($headerTotal) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->
