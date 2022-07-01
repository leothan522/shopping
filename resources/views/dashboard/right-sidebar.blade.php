<div class="p-3">
    {{--<h5>Title</h5>
    <p>Sidebar content</p>--}}

    <ul class="nav nav-pills flex-column">
        @livewire('dolar-component')
        <li class="dropdown-divider"></li>
        <li class="nav-item">
            <span class="text-small text-muted float-right">Web</span>
        </li>
        <li class="nav-item">
            <a href="{{ route('web.home') }}" class="nav-link" target="_blank">
                <i class="fas fa-store-alt"></i> Home
            </a>
        </li>
        @if(Auth::user()->role == 100)
        <li class="dropdown-divider"></li>
        <li class="nav-item">
            <span class="text-small text-muted float-right">Android</span>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.home', auth()->id()) }}" class="nav-link" target="_blank">
                <i class="fas fa-store-alt"></i> Home
            </a>
        </li>
        @endif
        {{--<li class="dropdown-divider"></li>--}}
        {{--<li class="dropdown-divider"></li>
        <li class="nav-item">
            <a href="#" class="nav-link" target="_blank">
                <i class="fas fa-sign-out-alt"></i> Salir
            </a>
        </li>--}}


    </ul>

</div>

