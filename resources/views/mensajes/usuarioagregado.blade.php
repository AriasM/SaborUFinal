@extends('layouts.principal')
@section('contenido')
<div class="row x_title">
  <div class="col-md-6">
    <h3>Éxito</h3>
  </div>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="alert alert-success">
    	<strong>¡Éxito!</strong>{{ $mensaje }}
	</div>
</div>
@endsection