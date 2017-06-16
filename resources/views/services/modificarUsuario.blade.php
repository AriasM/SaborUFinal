@extends('layouts.principal')
@section('contenido')
<div class="col-md-6 col-sm-6 col-xs-6">
	<h2>Usuario:</h2>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Correo</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{$user->name}}</td>
					<td>{{$user->last_name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->role}}</td>
					<td><a href="editUser/{{$user->id}}" class="btn btn-primary">Editar</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
