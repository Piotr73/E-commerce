


$('#btnedit').on('click',function(e){
	e.preventDefault();
	Habilitar();
});

function Habilitar(){
	$('#btnedit').addClass('hidden');
	$('#btneditar').removeClass('hidden');
	$('#nombre_producto').removeAttr('disabled');
	$('#precio_pu').removeAttr('disabled');
	$('#precio_fe').removeAttr('disabled');
	$('#stock').removeAttr('disabled');
	$('#stock_min').removeAttr('disabled');
	$('#id_marca').removeAttr('disabled');
	$('#id_categoria').removeAttr('disabled');
	$('#id_modelo').removeAttr('disabled');
	$('#desc').removeAttr('disabled');
	$('#addfotos').removeAttr('disabled');
	$('#lmpfotos').removeAttr('disabled');
	$('#btnenviar').removeAttr('disabled');
}

function Deshabilitar(){
	$('#btnedit').removeClass('hidden');
	$('#btneditar').addClass('hidden');
	$('#nombre_producto').attr('disabled', 'disabled');
	$('#precio_pu').attr('disabled', 'disabled');
	$('#precio_fe').attr('disabled', 'disabled');
	$('#stock').attr('disabled', 'disabled');
	$('#stock_min').attr('disabled', 'disabled');
	$('#id_marca').attr('disabled', 'disabled');
	$('#id_categoria').attr('disabled', 'disabled');
	$('#id_modelo').attr('disabled', 'disabled');
	$('#desc').attr('disabled', 'disabled');
	$('#addfotos').attr('disabled', 'disabled');
	$('#lmpfotos').attr('disabled', 'disabled');
	$('#btnenviar').attr('disabled', 'disabled');
}

$('#btncancelar').on('click',function(e){
	e.preventDefault();
	location.reload();
});

$('#lmpfotos').on('click',function(e){
        e.preventDefault();
        $('#seccionimg').html('');
        $('#ind').val('0');
        document.getElementById("ImgPrd").value = null;
});

 $('#ImgPrd').on('change',function(){
      $('#seccionimg').html('');
      var archivos = document.getElementById('ImgPrd').files;
      var navegador = window.URL || window.webkitURL;
      $('#ind').val('1');
      for (x=0 ; x< 3; x++) 
       {
              var size = archivos[x].size;
              var type = archivos[x].type;
              var name = archivos[x].name;
              var objeto_url = navegador.createObjectURL(archivos[x]);
              $('#seccionimg').append("<div class='row' style='padding: 10px;'>"+
                "<div class='col-md-4'>"+
                    "<img src="+objeto_url+" class='img-responsive'>"+
                "</div><div class='col-md-8'>"+name+"</div></div>");
          }
    });


 function validaciones(id){
            var n = $('#nombre_producto').val();
            var p = $('#precio_pu').val();
            var f = $('#precio_fe').val();
            var st = $('#stock').val();
            var stmin = $('#stock_min').val();
            var desc = $('#desc').val();
            var mar = $('#id_marca').val();
            var cat = $('#id_categoria').val();
            var mod = $('#id_modelo').val();
            var ind = $('#ind').val();
            var id =$('#id_user').val();
            
            if(n=="" || p==""|f==""||st==""||stmin==""||desc==""||mar==""||cat==""||mod==""){
                return 0;
            }else{
                return 1;
            }
    }