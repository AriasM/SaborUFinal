@extends('layouts.principal')
@section('contenido')
<div class="">
	<div class="page-title">
    	<div class="title_left">
        	<h3>Perfil</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    	<div class="row">
        	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
                	<div class="x_title">
                    	<h2>Perfil de usuario</h2>
                    	<div class="clearfix"></div>
                  		</div>
                  		<div class="x_content">
                    		<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      			<div class="profile_img">
                        			<div id="crop-avatar">
                          				<!-- Current avatar -->
                          				<img class="img-responsive avatar-view" src="/images/profile.png" alt="Avatar" title="Change the avatar">
                        			</div>
                      			</div>
                      			<h3>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h3>
                      			<ul class="list-unstyled user_data">
                        			<li>
                          				<i class="fa fa-briefcase user-profile-icon"></i> 
                          					@if ( Auth::user()->role == 1 )
                          						<label>Administrador</label>
                          					@else
                          						<label>Dependiente</label>
                          					@endif
                        			</li>
                        			<li class="m-top-xs">
                          				<i class="fa fa-external-link user-profile-icon"></i>
                          				<a target="_blank">{{ Auth::user()->email }}</a>
                        			</li>
                      			</ul>
                    		</div>
                    		<div class="col-md-9 col-sm-9 col-xs-12">
                      			<div class="profile_title">
                        			<div class="col-md-6">
                          				<h4>Cambiar Contraseña</h4>
                        			</div>
                      			</div>
                      			<div class="col-md-9"><br>
                      				<form class="form-horizontal" role="form" method="post" action="{{ route('change') }}">
                      				{{ csrf_field() }}
                      				<div class="form-group{{ $errors->has('contraseñaActual') ? ' has-error' : '' }}">
                            				<label for="contraseñaActual" class="col-md-4 control-label">Contraseña actual</label>
                            				<div class="col-md-6">
                                				<input id="contraseñaActual" type="password" class="form-control" name="contraseñaActual" required>
                                				@if ($errors->has('contraseñaActual'))
                                    				<span class="help-block">
                                        				<strong>{{ $errors->first('contraseñaActual') }}</strong>
                                    				</span>
                                				@endif
                            				</div>
                        				</div>
                      		 			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            				<label for="password" class="col-md-4 control-label">Nueva Contraseña</label>
                            				<div class="col-md-6">
                                				<input id="password" type="password" class="form-control" name="password" required>
                                				@if ($errors->has('password'))
                                    				<span class="help-block">
                                        				<strong>{{ $errors->first('password') }}</strong>
                                    				</span>
                                				@endif
                            				</div>
                        				</div>
                        				<div class="form-group">
                            				<label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>
                            				<div class="col-md-6">
                                				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            				</div>
                        				</div>
                        				<div class="form-group">
                            				<div class="col-md-6 col-md-offset-4">
                                				<button type="submit" class="btn btn-primary">Cambiar</button>
                            				</div>
                        				</div>
                        				<div class="alert alert-info">
                        					Una vez cambiada la contraseña debes volver a iniciar sesión.
                        				</div>
                      				</form>
                      			</div>
                  			</div>
                		</div>
              		</div>
            	</div>
          </div>
</div>
@endsection