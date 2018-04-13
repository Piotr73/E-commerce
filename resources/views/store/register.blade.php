@extends('layouts.auth')

@section('htmlheader_title')
    Registro
@endsection
@include('layouts.partials_plantilla.mainheader')
@section('content')
<body class="hold-transition register-page">
	<div class="container">
		<div class="col-md-6 col-md-push-3">
	    	<div class="register-box">
        	@if (count($errors) > 0)
            	<div class="alert alert-danger">
                	<strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                	<ul>
                    	@foreach ($errors->all() as $error)
                        	<li>{{ $error }}</li>
                    	@endforeach
                	</ul>
            	</div>
        	@endif
        	<div class="register-box-body">
            	<p class="login-box-msg">Registrarme</p>
            	<form action="{{ url('/register') }}" method="post">
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                	<div class="form-group has-feedback">
                    	<input type="text" class="form-control" placeholder="{{ trans('adminlte_lang::message.fullname') }}" name="name" value="{{ old('name') }}"/>
                    	<span class="glyphicon glyphicon-user form-control-feedback"></span>
                	</div>
                	<div class="form-group has-feedback">
                    	<input type="text" class="form-control" placeholder="Apellido Paterno" name="pat" value=""/>
                    	<span class="glyphicon glyphicon-user form-control-feedback"></span>
                	</div>
                	<div class="form-group has-feedback">
                    	<input type="text" class="form-control" placeholder="Apellido Materno" name="mat" value=""/>
                    	<span class="glyphicon glyphicon-user form-control-feedback"></span>
                	</div>
                	<div class="form-group has-feedback">
                    	<input type="text" class="form-control" placeholder="DOI" name="doi" value=""/>
                    	<span class="glyphicon glyphicon-user form-control-feedback"></span>
                	</div>
                	<div class="form-group has-feedback">
                    	<input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" value="{{ old('email') }}"/>
                    	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                	</div>
                	<div class="form-group has-feedback">
                    	<input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                    	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
                	</div>
                	<div class="form-group has-feedback">
                    	<input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}" name="password_confirmation"/>
                    	<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                	</div>
                	<div class="row">
                    	<div class="col-xs-1">
                        	<label>
                            <div class="checkbox_register icheck">
                                <label>
                                    <input type="checkbox" name="terms">
                                </label>
                            </div>
                        </label>
                    </div><!-- /.col -->
                    <div class="col-xs-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-block btn-flat" data-toggle="modal" data-target="#termsModal">Estoy de Acuerdo</button>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-5 col-xs-push-1">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte_lang::message.register') }}</button>
                    </div><!-- /.col -->
                </div>
            </form>
        		</div><!-- /.form-box -->
    		</div><!-- /.register-box -->

    @include('layouts.partials.scripts_auth')

    @include('auth.terms')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });

    </script>
	</div>
</div>
</body>
@include('layouts.partials_plantilla.footer')
@section('scripts')
    @include('layouts.partials_plantilla.scripts')
@show
</body>
@endsection

