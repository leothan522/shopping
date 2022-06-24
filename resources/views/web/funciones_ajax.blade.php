<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const Cargando = Swal.mixin({
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        },
        showConfirmButton: false,
        width: '100',
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    function preSubmit(){
        Cargando.fire();
    }

    $(".btn_favoritos").click(function(e) {
        e.preventDefault();
        Cargando.fire();
        let producto = this.getAttribute('content');
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.favoritos') }}",
                data: {id_producto: producto},
                success: function (data) {
                    Toast.fire({
                        icon: data.type,
                        title: data.message,
                    });
                    let div = document.getElementById('header_favoritos');
                    div.innerHTML = data.cantidad;
                    /*if (data.type === "success") {
                        document.getElementById(data.id).classList.add('fondo-favoritos');
                    } else {
                        document.getElementById(data.id).classList.remove('fondo-favoritos');
                    }*/

                }
            });
        });

    $(".btn_carrito").click(function(e) {
        e.preventDefault();
        Cargando.fire();
        let producto = this.getAttribute('content');
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {id_producto: producto},
            success: function (data) {
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                let div = document.getElementById('header_carrito');
                div.innerHTML = data.cantidad;
                /*if (data.type === "success") {
                    document.getElementById(data.id).classList.add('fondo-favoritos');
                } else {
                    document.getElementById(data.id).classList.remove('fondo-favoritos');
                }*/

            }
        });
    });
</script>
