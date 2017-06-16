@extends('layouts.principal')
@section('contenido')
<div class="row x_title">
  <div class="col-md-6">
    <h3>Eliminar Usuario</h3>
  </div>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<h2>Usuario:</h2>
	<form role="form" method="POST" action="{{ route('delete') }}">
	{{ csrf_field() }}
		<div class="col-md-4 col-sm-4 col-xs-4 form-group">	
			<select id="user"  class="form-control" name="user">
			@foreach($users as $user)
				<option value="{{$user->id}}">{{$user->name}}</option>
			@endforeach
			</select>
		</div>
		<div class="form-group">
			<div class="col-md-6 ">
            	<button type="submit" class="btn btn-primary">Eliminar</button>
			</div>
        </div>
	</form>
</div>
@endsection