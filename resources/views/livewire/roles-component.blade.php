<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if(leerJson(Auth::user()->permisos, 'usuarios.roles') || Auth::user()->role == 1 || Auth::user()->role == 100)
        @include('dashboard.usuarios.roles')
    @endif
</div>
