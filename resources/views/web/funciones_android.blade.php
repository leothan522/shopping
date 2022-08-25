@if($ruta != 'android')
    <script type="text/javascript">
        $("#tel_phone").click(function(e) {
            e.preventDefault();
            let telefono = this.dataset.telefono;
            //alert(telefono);
        });
    </script>
@else
    <script type="text/javascript">
        $("#tel_phone").click(function(e) {
            e.preventDefault();
            let telefono = this.dataset.telefono;
            Android.irLlamadas(telefono);
            ///alert(telefono);
        });
    </script>
@endif
