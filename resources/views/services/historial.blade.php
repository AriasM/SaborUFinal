@extends('layouts.principal')
@section('contenido')
<div class="row x_title">
  <div class="col-md-6">
    <h3>Historial de pedidos</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-3">
    <h4>Filtrar</h4>
  <div>
  <select class="form-control" onchange="habilitarFiltroFecha(this.value)">
    <option value="1">Todos los pedidos</option>
    <option value="2">Período de tiempo</option>
  </select>
  </div><br>
    <div class="col-md-3 col-xs-3 fechaPedidos" style="visibility: hidden;">
      <div class="input-prepend input-group">
        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
        <input type="text" style="width: 200px" name="fechaFiltro" id="fechaFiltro" class="form-control" value="01/01/2017 - 01/02/2017" />
      </div>
      <button type="button" class="btn btn-success" onclick="filtrarHistorial()">Consultar</button>
    </div>
  </div>
</div><br>
<div class="row" id="contenedorPrincipal">
  <div class="col-md-2 col-sm-2 col-xs-2" style="float: right;">
    <input type="button" id="btnExport" class="btn btn-info" value="Exportar a Excel">
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12" id="dvData">
    <table id="tablePedidos" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Pedido</th>
          <th>Cantidad</th>
          <th>Cliente</th>
          <th>Observaciones</th>
          <th>Estado</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody id="tbPedidos">
      </tbody>
    </table>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    establecerConexion();
    cargarDatosHistorial();
  });

  function habilitarFiltroFecha(valor){
    if (valor==2) {
      $('.fechaPedidos').attr("style", "visibility: visible");
    }
    if (valor==1){
      $('.fechaPedidos').attr("style", "visibility: hidden");
        cargarDatosHistorial();
      }
    }
</script>
@endpush
@push('scriptsDown')
<script type="text/javascript">
  $('#fechaFiltro').daterangepicker({
    locale: {
      format: 'DD/MM/YYYY'
    }
  });
</script>
<script>
  $("#btnExport").click(function(e) {
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
    e.preventDefault();
  });
</script>
@endpush
