<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<!--<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<!--<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>

<script src="{{asset('js/jquery.alertable.min.js') }}"></script>

<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('/js/plusis.js') }}" type="text/javascript"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>

    var CargarPerfil = function(id) {
        var route = "{{url('usuarios/usuario')}}/" + id + "/CargarPerfil";
        $.get(route, function (data) {
            $('#id_usuario').val(data[0].id);
            $('#nombre').val(data[0].nombre);
            $('#dni').val(data[0].dni);
            $('#email').val(data[0].email);
            $('#fecha_u').val(data[0].user_r);
            $('#perfil_mod').modal({
                show: true,
                backdrop: 'static'
            });
            return false;
        });
    }
</script>
<script type="text/javascript" src="{{asset('/vendors/ckeditor/ckeditor.js')}}"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->