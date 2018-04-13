@extends('layouts.auth')

@section('htmlheader_title')
    Login
@endsection
@include('layouts.partials_plantilla.mainheader')
@section('content')
<body>
<div class="login-page">
		<div class="container"> 
			<h3 class="w3ls-title w3ls-title1">Ingrese a su cuenta</h3>  

			<div class="login-body">
				@if (count($errors) > 0)
        		<div class="alert alert-danger">
            		<strong>Ups!</strong> Ha ocurrido un problema<br><br>
            		<ul>
                		@foreach ($errors->all() as $error)
                    	<li>{{ $error }}</li>
                		@endforeach
            		</ul>
        		</div>
    			@endif
    			<form action="{{ url('/login') }}" method="post">
        			<input type="hidden" name="_token" value="{{ csrf_token() }}">
        			<div class="form-group has-feedback">
            			<input type="email" class="form-control" value="{{ old('email')}}"  placeholder="Ingrese su email" name="email"/>
            			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        			</div>
        			<div class="form-group has-feedback">	
            			<input type="password" class="form-control" placeholder=" ingrese su contraseña" name="password"/>
            			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
        			</div>
        			<!--<div class="row">-->
        				<div class="forgot-grid">
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Recuérdame</label>
							<div class="forgot">
								<a href="{{ url('/password/reset') }}">¿Olvidó su Contraseña?</a>
							</div>
							<div class="clearfix"> </div>
						</div>
            			<div class="col-xs-5">
                			<button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            			</div><!-- /.col -->
        			<!--</div>-->
    			</form>
				<!--<form action="#" method="post">
					<input type="text" class="user" name="email" placeholder="Enter your email" required="">
					<input type="password" name="password" class="lock" placeholder="Password" required="">
					<input type="submit" value="Login">
					<div class="forgot-grid">
						<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Recuérdame</label>
						<div class="forgot">
							<a href="#">¿Olvidó su Contraseña?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>-->
			</div>  
			<h6> Not a Member? <a href="#">Registrarme »</a> </h6> 
			<div class="login-page-bottom social-icons">
				<h5>Ingresar con:</h5>
				<ul>
					<li><a href="#" class="fa fa-facebook icon facebook"> </a></li>
					<li><a href="#" class="fa fa-twitter icon twitter"> </a></li>
					<li><a href="#" class="fa fa-google-plus icon googleplus"> </a></li>
					<li><a href="#" class="fa fa-dribbble icon dribbble"> </a></li>
					<li><a href="#" class="fa fa-rss icon rss"> </a></li> 
				</ul> 
			</div>
		</div>
</div>
@include('layouts.partials_plantilla.footer')
@section('scripts')
    @include('layouts.partials_plantilla.scripts')
@show
</body>
@endsection

