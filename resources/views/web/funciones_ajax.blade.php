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
        //let producto = this.getAttribute('content');
        let producto = this.dataset.idStock;
        let cantidad = this.dataset.cantidad;
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.favoritos') }}",
                data: {
                    id_stock: producto
                },
                success: function (data) {
                    Toast.fire({
                        icon: data.type,
                        title: data.message,
                    });
                    let div = document.getElementById('header_favoritos');
                    div.innerHTML = data.cantidad;
                    if (data.type === "success"){
                        document.getElementById(data.id).classList.add('fondo-favoritos')
                    }else{
                        document.getElementById(data.id).classList.remove('fondo-favoritos')
                    }
                }
            });
        });

    $(".btn_carrito").click(function(e) {
        e.preventDefault();
        Cargando.fire();
        let producto = this.dataset.idStock;
        let cantidad = this.dataset.cantidad;
        let opcion = this.dataset.opcion;
        if (opcion == "agregar"){
            let agregar = document.getElementById('cantAgregar')
            cantidad = agregar.value;
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {
                id_stock: producto,
                cantidad: cantidad,
                opcion:opcion,
            },
            success: function (data) {
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                let div = document.getElementById('header_carrito');
                div.innerHTML = data.cantidad;
                let header = document.getElementById('header_item');
                header.innerHTML = "$" + data.items;
                if (data.opcion === "agregar"){
                    let cart = document.getElementById('cart_actual');
                    cart.innerHTML = data.cart;
                    document.getElementById(data.input).value = 1;
                }
                if (data.type === "success"){
                    document.getElementById(data.id).classList.add('fondo-favoritos')
                }
            }
        });
    });

    $(".btn_remover").click(function(e) {
        e.preventDefault();
        Cargando.fire();
        let carrito = this.dataset.idCarrito;
        let item = this.dataset.item;
        let opcion = "remover";
        let subtotal = document.getElementById('carrito_subtotal');
        let iva = document.getElementById('carrito_iva');
        let total = document.getElementById('carrito_total');
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {
                id_carrito: carrito,
                tr: item,
                opcion:opcion,
                subtotal: subtotal.dataset.cantidad,
                iva: iva.dataset.cantidad,
                total: total.dataset.cantidad,
            },
            success: function (data) {
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                if (data.type === "success"){
                    //document.getElementById(data.id).classList.add('fondo-favoritos')
                    let subtotal = document.getElementById('carrito_subtotal');
                    let iva = document.getElementById('carrito_iva');
                    let total = document.getElementById('carrito_total');
                    subtotal.dataset.cantidad = data.subtotal;
                    subtotal.innerHTML = data.label_subtotal;
                    iva.dataset.cantidad = data.iva;
                    iva.innerHTML = data.label_iva;
                    total.dataset.cantidad = data.total;
                    total.innerHTML = data.label_total;
                    $("#"+data.tr).remove();
                }
            }
        });
    });

    function botonesCarrito(boton, oldValue, id_carrito){
        Cargando.fire();
        //alert("btn: " + boton + "| value: " +  oldValue + "| id: " +  id_carrito);
        let subtotal = document.getElementById('carrito_subtotal');
        let iva = document.getElementById('carrito_iva');
        let total = document.getElementById('carrito_total');
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {
                id_carrito: id_carrito,
                opcion:"editar",
                boton:boton,
                valor:oldValue,
                subtotal: subtotal.dataset.cantidad,
                iva: iva.dataset.cantidad,
                total: total.dataset.cantidad,
            },
            success: function (data) {
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                if (data.type === "success"){
                    //document.getElementById(data.id).classList.add('fondo-favoritos')
                    /*let subtotal = document.getElementById('carrito_subtotal');
                    let iva = document.getElementById('carrito_iva');
                    let total = document.getElementById('carrito_total');
                    subtotal.dataset.cantidad = data.subtotal;
                    subtotal.innerHTML = data.label_subtotal;
                    iva.dataset.cantidad = data.iva;
                    iva.innerHTML = data.label_iva;
                    total.dataset.cantidad = data.total;
                    total.innerHTML = data.label_total;
                    $("#"+data.tr).remove();*/
                }
            }
        });
    }

    $(".btn_editar_input").bind("change", function(){
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var id_carrito = $button.parent().find('input')[0].dataset.idCarrito;
        botonesCarrito('input', oldValue, id_carrito);
    });

    $(".qtybtn").click(function(e) {
        var $button = $(this);
        if ($button.hasClass('inc')) {
            var boton = "btn-sumar";
        }else{
            var boton = "btn-restar";
        }
        var oldValue = $button.parent().find('input').val();
        var id_carrito = $button.parent().find('input')[0].dataset.idCarrito;
        if(id_carrito){
            botonesCarrito(boton, oldValue, id_carrito);
        }

        /*e.preventDefault();*/
        //Cargando.fire();
        /*let carrito = this.dataset.idCarrito;
        let item = this.dataset.item;
        let opcion = "remover";
        let subtotal = document.getElementById('carrito_subtotal');
        let iva = document.getElementById('carrito_iva');
        let total = document.getElementById('carrito_total');
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {
                id_carrito: carrito,
                tr: item,
                opcion:opcion,
                subtotal: subtotal.dataset.cantidad,
                iva: iva.dataset.cantidad,
                total: total.dataset.cantidad,
            },
            success: function (data) {
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                if (data.type === "success"){
                    //document.getElementById(data.id).classList.add('fondo-favoritos')
                    let subtotal = document.getElementById('carrito_subtotal');
                    let iva = document.getElementById('carrito_iva');
                    let total = document.getElementById('carrito_total');
                    subtotal.dataset.cantidad = data.subtotal;
                    subtotal.innerHTML = data.label_subtotal;
                    iva.dataset.cantidad = data.iva;
                    iva.innerHTML = data.label_iva;
                    total.dataset.cantidad = data.total;
                    total.innerHTML = data.label_total;
                    $("#"+data.tr).remove();
                }
            }
        });*/
    });



</script>
