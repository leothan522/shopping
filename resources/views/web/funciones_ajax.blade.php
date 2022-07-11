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

    const Alerta = Swal.mixin({
        toast: false,
        //position: 'top-end',
        showConfirmButton: true,
        //timer: 3000,
        //timerProgressBar: true,
        /*didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }*/
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

                if(data.type === "warning"){

                    Alerta.fire({
                        icon: data.type,
                        title: data.message,
                        //text: data.message,
                    });

                }else{

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


            }
        });
    });

    $(".btn_remover").click(function(e) {
        e.preventDefault();
        Cargando.fire();
        let carrito = this.dataset.idCarrito;
        let item = this.dataset.itemCarrito;
        let opcion = "remover";
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {
                id_carrito: carrito,
                tr: item,
                opcion:opcion,
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
                    let delivery = document.getElementById('carrito_delivery');
                    let header_items = document.getElementById('header_item')                                                                                                                                                                                                                                                                                                                                                                                                           ;
                    let boton = document.getElementById('btn_procesar_carrito')                                                                                                                                                                                                                                                                                                                                                                                                           ;
                    subtotal.dataset.cantidad = data.subtotal;
                    subtotal.innerHTML = data.label_subtotal;
                    iva.dataset.cantidad = data.iva;
                    iva.innerHTML = data.label_iva;
                    total.dataset.cantidad = data.total;
                    total.innerHTML = data.label_total;
                    delivery.dataset.cantidad = data.delivery;
                    delivery.innerHTML = data.label_delivery;
                    header_items.innerText = data.label_total;
                    $("#"+data.tr).remove();
                    if(!data.total){
                        boton.dataset.estatus = "vacio";
                        document.getElementById('li_delivery').classList.add('d-none');
                        document.getElementById('lista_zonas').classList.add('d-none');
                        document.getElementById('boton_incluir_del').classList.add('d-none');

                    }
                }
            }
        });
    });

    function botonesCarrito(boton, oldValue, carrito_id, carrito_item){
        Cargando.fire();
        //alert("btn: " + boton + "| value: " +  oldValue + "| carrito_id: " +  carrito_id + " | carrito_item: " + carrito_item);
        let subtotal = document.getElementById('carrito_subtotal');
        let iva = document.getElementById('carrito_iva');
        let total = document.getElementById('carrito_total');
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {
                opcion:"editar",
                boton:boton,
                valor:oldValue,
                carrito_id: carrito_id,
                carrito_item: carrito_item,
                subtotal: subtotal.dataset.cantidad,
                iva: iva.dataset.cantidad,
                total: total.dataset.cantidad,
            },
            success: function (data) {

                if(data.type === "warning"){

                    Alerta.fire({
                        icon: data.type,
                        title: data.message,
                        //text: data.message,
                    });
                    var proQty = $('#' + data.id);
                    proQty.val(data.cantidad);

                }else{

                    Toast.fire({
                        icon: data.type,
                        title: data.message,
                    });
                    if (data.type === "success"){
                        //document.getElementById(data.id).classList.add('fondo-favoritos')
                        let subtotal = document.getElementById('carrito_subtotal');
                        let iva = document.getElementById('carrito_iva');
                        let total = document.getElementById('carrito_total');
                        let delivery = document.getElementById('carrito_delivery');
                        let header_items = document.getElementById('header_item');
                        let carrito_item = document.getElementById(data.carrito_item);
                        let boton = document.getElementById('btn_procesar_carrito')
                        subtotal.dataset.cantidad = data.subtotal;
                        subtotal.innerHTML = data.label_subtotal;
                        iva.dataset.cantidad = data.iva;
                        iva.innerHTML = data.label_iva;
                        total.dataset.cantidad = data.total;
                        total.innerHTML = data.label_total;
                        delivery.dataset.cantidad = data.delivery;
                        delivery.innerHTML = data.label_delivery;
                        carrito_item.innerHTML = data.label_carrito_item;
                        header_items.innerText = data.label_total;
                        if (data.borrar === "si"){
                            //let tr = document.getElementById(data.tr)
                            $("#"+data.tr).remove();
                        }
                        if(!data.total){
                            boton.dataset.estatus = "vacio";
                            document.getElementById('li_delivery').classList.add('d-none');
                            document.getElementById('lista_zonas').classList.add('d-none');
                            document.getElementById('boton_incluir_del').classList.add('d-none');
                        }

                    }

                }
            }
        });
    }

    $(".btn_editar_input").bind("change", function(){
        var boton = "input";
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var carrito_id = $button.parent().find('input')[0].dataset.carritoId;
        var carrito_item = $button.parent().find('input')[0].dataset.carritoItem;
        //alert()
        if(carrito_id){
            botonesCarrito(boton, oldValue, carrito_id, carrito_item);
        }
    });

    $(".qtybtn").click(function(e) {
        var $button = $(this);
        if ($button.hasClass('inc')) {
            var boton = "btn-sumar";
        }else{
            var boton = "btn-restar";
        }
        //var id = $button.parent().find('input');
        var oldValue = $button.parent().find('input').val();
        var carrito_id = $button.parent().find('input')[0].dataset.carritoId;
        var carrito_item = $button.parent().find('input')[0].dataset.carritoItem;
        if(carrito_id){
            botonesCarrito(boton, oldValue, carrito_id, carrito_item);
        }

    });

    $(".btn-delivery").click(function(e) {
        e.preventDefault();
        Cargando.fire();
        let opcion = "remover-delivery";
        let accion = this.dataset.accion;
        let zona = document.getElementById("select_zo").value;
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {
                opcion:opcion,
                accion:accion,
                zona:zona
            },
            success: function (data) {
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                let boton = document.getElementById('btn_delivery');
                let div = document.getElementById('lista_zonas');
                let estatus_zona = document.getElementById('estatus_zona');
                if (data.accion === "incluir"){
                    //document.getElementById(data.id).classList.add('fondo-favoritos')
                    div.classList.add('d-none');
                    boton.innerText = "INCLUIR DELIVERY";
                    boton.dataset.accion = "incluir";
                    estatus_zona.value = "inactivo";
                    //$("#"+data.tr).remove();
                }else{
                    div.classList.remove('d-none');
                    boton.innerText = "NO INCLUIR DELIVERY";
                    boton.dataset.accion = "remover";
                    //$("#select_zonas").val("hola");
                    estatus_zona.value = "activo";
                }
                let subtotal = document.getElementById('carrito_subtotal');
                let iva = document.getElementById('carrito_iva');
                let total = document.getElementById('carrito_total');
                let delivery = document.getElementById('carrito_delivery');
                let header_items = document.getElementById('header_item');
                subtotal.dataset.cantidad = data.subtotal;
                subtotal.innerHTML = data.label_subtotal;
                iva.dataset.cantidad = data.iva;
                iva.innerHTML = data.label_iva;
                total.dataset.cantidad = data.total;
                total.innerHTML = data.label_total;
                delivery.dataset.cantidad = data.delivery;
                delivery.innerHTML = data.label_delivery;
                header_items.innerText = data.label_total;
                if(delivery.dataset.cantidad > 0){
                    document.getElementById('li_delivery').classList.remove('d-none');
                }else{
                    document.getElementById('li_delivery').classList.add('d-none');
                }
            }
        });
    });

    $(".select-zonas").change(function(e) {
        e.preventDefault();
        Cargando.fire();
        let opcion = "select-delivery";
        let zona = this.value;
        //alert(this.value);
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.carrito') }}",
            data: {
                opcion:opcion,
                zona:zona
            },
            success: function (data) {
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                /*let boton = document.getElementById('btn_delivery');
                let div = document.getElementById('lista_zonas');
                if (data.accion === "incluir"){
                    //document.getElementById(data.id).classList.add('fondo-favoritos')
                    div.classList.add('d-none');
                    boton.innerText = "INCLUIR DELIVERY";
                    boton.dataset.accion = "incluir";
                    //$("#"+data.tr).remove();
                }else{
                    div.classList.remove('d-none');
                    boton.innerText = "NO INCLUIR DELIVERY";
                    boton.dataset.accion = "remover";
                    //$("#select_zonas").val("hola");
                }
                */
                let subtotal = document.getElementById('carrito_subtotal');
                let iva = document.getElementById('carrito_iva');
                let total = document.getElementById('carrito_total');
                let delivery = document.getElementById('carrito_delivery');
                let header_items = document.getElementById('header_item');
                subtotal.dataset.cantidad = data.subtotal;
                subtotal.innerHTML = data.label_subtotal;
                iva.dataset.cantidad = data.iva;
                iva.innerHTML = data.label_iva;
                total.dataset.cantidad = data.total;
                total.innerHTML = data.label_total;
                delivery.dataset.cantidad = data.delivery;
                delivery.innerHTML = data.label_delivery;
                header_items.innerText = data.label_total;
                //alert(delivery.dataset.cantidad);
                if(delivery.dataset.cantidad > 0){
                    document.getElementById('li_delivery').classList.remove('d-none');
                }else{
                    document.getElementById('li_delivery').classList.add('d-none');
                }
            }
        });
    });

    $(".btn_procesar_carrito").click(function(e) {
        e.preventDefault();
        //Cargando.fire();
        let estatus = this.dataset.estatus;
        if(estatus == "vacio"){
            //Cargando.fire();
            Alerta.fire({
                icon: "warning",
                title: "Tu carrito esta vacio.",
                //text: data.message,
            });
        }else{
            let estatus_zona = document.getElementById('estatus_zona').value;
            let zona_id = document.getElementById('select_zo').value;
            //alert(estatus_zona + " | " + zona_id);
            if (estatus_zona == "activo" && zona_id == "vacia"){
                //alert('elije zona para envio')
                Alerta.fire({
                    icon: "warning",
                    title: "Elije la zona para el envio.",
                    //text: data.message,
                });

            }else{
                //alert('procesar')
                Cargando.fire();
                let opcion = 'btn-procesar';
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.carrito') }}",
                    data: {
                        opcion:opcion,
                    },
                    success: function (data) {

                        if(data.type === "warning"){

                            Alerta.fire({
                                icon: data.type,
                                title: data.message,
                                //text: data.message,
                            });

                        }else{
                            let ruta = document.getElementById('ruta_app').value;
                            if (ruta === "android"){
                                window.location.href = "{{ route('android.checkout', auth()->id()) }}" + "/" + data.id;
                            }else{
                                window.location.href = "{{ route('web.checkout') }}" + "/" + data.id;
                            }
                        }
                    }
                });
            }
        }
    });

    $("#checkout_cedula").change(function(e) {
        e.preventDefault();
        Cargando.fire();
        let cedula = this.value;
        //alert(cedula);
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.cliente') }}",
            data: {
                cedula:cedula,
            },
            success: function (data) {
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                let cedula = document.getElementById('checkout_cedula');
                let nombre = document.getElementById('checkout_nombre');
                let telefono = document.getElementById('checkout_telefono');
                let direccion_1 = document.getElementById('checkout_direccion_1');
                let direccion_2 = document.getElementById('checkout_direccion_2');
                cedula.dataset.opcion = data.opcion;
                nombre.value = data.nombre;
                telefono.value = data.telefono;
                direccion_1.value = data.direccion_1;
                direccion_2.value = data.direccion_2;
                /*let subtotal = document.getElementById('carrito_subtotal');
                subtotal.dataset.cantidad = data.subtotal;
                subtotal.innerHTML = data.label_subtotal;*/
            }
        });
    });

    $("#checkout_metodo").change(function(e) {
        e.preventDefault();
        Cargando.fire();
        let id_parametro = this.value;
        let bs = document.getElementById('monto_bolivares').dataset.cantidad;
        //alert(cedula);
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.metodo') }}",
            data: {
                id_parametro:id_parametro,
                bs:bs
            },
            success: function (data) {

                let div = document.getElementById('div_comprobante');
                let comprobante = document.getElementById('checkout_comprobante');
                let cuentas = document.getElementById('checkout_label_cuentas');
                cuentas.innerHTML = data.label;

                if(data.type === "warning"){

                    Alerta.fire({
                        icon: data.type,
                        title: data.message,
                        //text: data.message,
                    });

                    div.classList.add('d-none');
                    comprobante.dataset.requerido = "no";

                }else{

                    Toast.fire({
                        icon: data.type,
                        title: data.message,
                    });
                    if (data.div === 'quitar'){
                        div.classList.add('d-none');
                        comprobante.dataset.requerido = "no";
                    }else{
                        div.classList.remove('d-none');
                        comprobante.dataset.requerido = "si";
                    }
                }
            }
        });
    });

    $("#btn_procesar_pedido").click(function(e) {
        e.preventDefault();
        Cargando.fire();
        let cedula = document.getElementById('checkout_cedula').value;
        let opcion = document.getElementById('checkout_cedula').dataset.opcion;
        let nombre = document.getElementById('checkout_nombre').value;
        let telefono = document.getElementById('checkout_telefono').value;
        let direccion_1 = document.getElementById('checkout_direccion_1').value;
        let direccion_2 = document.getElementById('checkout_direccion_2').value;
        let metodo = document.getElementById('checkout_metodo').value;
        let comprobante = document.getElementById('checkout_comprobante').value;
        let requerido = document.getElementById('checkout_comprobante').dataset.requerido;
        let id_pedido = this.dataset.idPedido;
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.pedido') }}",
            data: {
                cedula:cedula,
                opcion:opcion,
                nombre:nombre,
                telefono:telefono,
                direccion_1:direccion_1,
                direccion_2:direccion_2,
                metodo:metodo,
                comprobante:comprobante,
                requerido:requerido,
                id_pedido:id_pedido
            },
            success: function (data) {

                if(data.type === "warning"){

                    Alerta.fire({
                        icon: data.type,
                        title: data.message,
                        //text: data.message,
                    });

                    let cedula = document.getElementById('alert_cedula');
                    let nombre = document.getElementById('alert_nombre');
                    let telefono = document.getElementById('alert_telefono');
                    let direccion_1 = document.getElementById('alert_direccion_1');
                    let metodo = document.getElementById('alert_metodo');
                    let comprobante = document.getElementById('alert_comprobante');

                    if (data.alert_cedula){
                        cedula.classList.remove('d-none');
                    }
                    if (data.alert_nombre){
                        nombre.classList.remove('d-none');
                    }
                    if (data.alert_telefono){
                        telefono.classList.remove('d-none');
                    }
                    if (data.alert_direccion_1){
                        direccion_1.classList.remove('d-none');
                    }
                    if (data.alert_metodo){
                        metodo.classList.remove('d-none');
                    }
                    if (data.alert_comprobante){
                        comprobante.classList.remove('d-none');
                    }

                }else{

                    let ruta = document.getElementById('ruta_app').value;
                    if (ruta === "android"){
                        window.location.href = "{{ route('android.pedidos', auth()->id()) }}" + "/" + data.id;
                    }else{
                        window.location.href = "{{ route('web.pedidos') }}" + "/" + data.id;
                    }

                    //window.location.href = "{{ route('web.pedidos') }}" + "/" + data.id;

                    /*Toast.fire({
                    icon: data.type,
                    title: data.message,
                    });*/

                }



                /*let div = document.getElementById('div_comprobante');
                let comprobante = document.getElementById('checkout_comprobante');
                let cuentas = document.getElementById('checkout_label_cuentas');
                cuentas.innerHTML = data.label;

                if(data.type === "warning"){

                    Alerta.fire({
                        icon: data.type,
                        title: data.message,
                        //text: data.message,
                    });

                    div.classList.add('d-none');
                    comprobante.dataset.requerido = "no";

                }else{

                    Toast.fire({
                        icon: data.type,
                        title: data.message,
                    });
                    if (data.div === 'quitar'){
                        div.classList.add('d-none');
                        comprobante.dataset.requerido = "no";
                    }else{
                        div.classList.remove('d-none');
                        comprobante.dataset.requerido = "si";
                    }
                }*/
            }
        });


    });
</script>
