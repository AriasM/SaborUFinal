@extends('layouts.principal')
@section('contenido')
<div class="row x_title">
  <div class="col-md-6">
    <h3>Eliminar Plato</h3>
  </div>
</div>
<div class="col-md-6 col-sm-6 col-xs-6 selectPlatos">
  <h2>Plato:</h2>
  <div class="col-md-4 col-sm-4 col-xs-4 form-group">
    <select class="form-control" id="selPlato" name="semana" onchange="eliminarPlato(this.value);">
    </select>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    obtenerPlatos();
  });
</script>
@endpush
