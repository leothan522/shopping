<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        @if(auth()->check())
                            <ul>
                            <li>
                                @if($ruta != "android")
                                    <a href="{{ route('web.perfil') }}" class="btn-link text-dark">
                                        <i class="fa fa-envelope"></i> {{ auth()->user()->email }}
                                    </a>
                                    @else
                                    <i class="fa fa-envelope"></i> {{ auth()->user()->email }}
                                @endif
                            </li>
                            <li>
                                @if($ruta != "android")
                                    <a href="{{ route('web.perfil') }}" class="btn-link text-dark">
                                        <i class="fa fa-user"></i> {{ auth()->user()->name }}
                                    </a>
                                @else
                                    <i class="fa fa-user"></i> {{ auth()->user()->name }}
                                @endif
                            </li>
                            {{--@if(auth()->user()->role > 1)
                                @if($ruta != "android")
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="btn-link text-dark">
                                            <i class="fas fa-tachometer-alt"></i> Dashboard
                                        </a>
                                    </li>
                                @endif
                            @endif--}}
                            <li>
                                @if($ruta != "android")
                                    <a href="{{ route('web.pedidos') }}" class="btn-link text-dark">
                                        <i class="fa fa-shopping-bag"></i> Tus Pedidos
                                    </a>
                                {{--@else
                                    <i class="fa fa-user"></i> {{ auth()->user()->name }}--}}
                                @endif
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        {{--<div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Spanis</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>--}}
                        <div class="header__top__right__auth">
                            @if(auth()->check())
                                <a href="{{ route('cerrar') }}"><i class="fa fa-power-off"></i> Cerrar</a>
                                @else
                                <a href="{{ route('web.home') }}"><i class="fa fa-user"></i> Login</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    @if(auth()->check())
                        <a href="
                    @if($ruta == 'android')
                        {{ route('android.home', auth()->id()) }}
                        @else
                        {{ route('web.home') }}
                        @endif
                            ">
                            <img src="{{ asset('img/logo_letras.png') }}" alt="">
                        </a>
                        @else
                        <a href="{{ route('web.index') }}">
                            <img src="{{ asset('img/logo_letras.png') }}" alt="">
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu"></nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li>
                            <a href="@if($ruta == 'android')
                            {{ route('android.favoritos', auth()->id()) }}
                            @else
                            {{ route('web.favoritos') }}
                            @endif">
                                <i class="fa fa-heart"></i> <span id="header_favoritos">{{ $headerFavoritos }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="
                            @if($ruta == 'android')
                            {{ route('android.carrito', auth()->id()) }}
                            @else
                            {{ route('web.carrito') }}
                            @endif
                                ">
                                <i class="fa fa-shopping-basket"></i> <span id="header_carrito">{{ formatoMillares($headerItems, 0) }}</span>
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
