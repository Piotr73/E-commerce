<div class="subscribe"> 
		<div class="container">
			<div class="col-md-6 social-icons w3-agile-icons">
				<h4>Estemos en Contacto</h4>  
				<ul>
					<li><a href="#" class="fa fa-facebook icon facebook"> </a></li>
					<li><a href="#" class="fa fa-twitter icon twitter"> </a></li>
					<li><a href="#" class="fa fa-google-plus icon googleplus"> </a></li>
					<li><a href="#" class="fa fa-dribbble icon dribbble"> </a></li>
					<li><a href="#" class="fa fa-rss icon rss"> </a></li> 
				</ul> 
				<div class="form-group">
					<br>
					<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
					<button class="btn btn-success" id="btnEjec">Ejecutar</button>
				</div>
				<!--<ul class="apps"> 
					<li><h4>Download Our app : </h4> </li>
					<li><a href="#" class="fa fa-apple"></a></li>
					<li><a href="#" class="fa fa-windows"></a></li>
					<li><a href="#" class="fa fa-android"></a></li>
				</ul> -->
			</div> 
			<!--<div class="col-md-6 subscribe-right">
				<h4>Sign up for email and get 25%off!</h4>  
				<form action="#" method="post"> 
					<input type="text" name="email" placeholder="Enter your Email..." required="">
					<input type="submit" value="Subscribe">
				</form>
				<div class="clearfix"> </div> 
			</div>-->
			<div class="clearfix"> </div>
		</div>
	</div>

	<script type="text/javascript">
		$('#btnEjec').on('click',function(e){
			e.preventDefault();
			
			var data = {'id':1};
			var token = $("input[name=_token]").val();
			var route = '/index';

			$.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type:'post' ,
            datatype: 'json',
            data: data,
            success: function(data){
              if(data.success == 'true'){
                  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
                  socket.emit('new_count_message', { 
                    new_count_message: data.new_count_message
                  });
              }
            }

        });			
		});
	</script>