@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.serviceunavailable') }}
@endsection

@section('contentheader_title')
    {{ trans('adminlte_lang::message.503error') }}
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-red"><i class="fa fa-user-times" aria-hidden="true"></i></h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Al parecer no cuenta con permisos para esta opción.</h3>
            <p>
                Favor de consultar con el Administrador del sistema. Mientras tanto, es posible <a href='{{url('/home') }}'>Volver al panel</a> o ingresar a otras opciones.
            </p>
        </div>
    </div><!-- /.error-page -->
@endsection