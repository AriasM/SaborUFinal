@extends('layouts.principal')
@section('contenido')
<div class="row tile_count" style="text-align: center; color: black;">
  <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
    <span class="count_top">Total de Pedidos</span><br>
    <label id="lbTotalPedidos" style="font-size: 150%;"></label>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
    <span class="count_top">Pedidos Entregados</span><br>
    <label id="lbEntregado" style="font-size: 150%;"></label>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
    <span class="count_top">Pedidos Pendientes</span><br>
    <label id="lbPendiente" style="font-size: 150%;"></label>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
    <span class="count_top">Fecha</span><br>
    <label id="lbFecha" style="font-size: 150%;"></label>
  </div>          
</div>
<div class="row x_title">
  <div class="col-md-6">
    <h3>Lista de Pedidos</h3>
  </div>
</div>
<div class="row" id="contenedorPrincipal">
  <div class="col-md-10 col-xs-10 col-sm-10">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    Pendientes</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
              <table class="table table-hover" id="tablaSemana1">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Plato</th>
                    <th>Cantidad</th>
                    <th>Observaciones</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="tablita">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    Entregados</a>
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
          <div class="panel-body">
            <table class="table table-hover" id="tablaSemana1">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Plato</th>
                  <th>Cantidad</th>
                  <th>Observaciones</th>
                  <th>Cliente</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tablita2">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    cargarPedidos();
    cargarPedidosTablas();
  });
</script>
@endpush
@push('scriptsDown')
<script>

      function cargarPedidos(){

        var lbFecha = document.getElementById('lbFecha');

        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        var f=new Date();

        lbFecha.innerHTML = (diasSemana[f.getDay()]+ " " + f.getDate() + " de " + meses[f.getMonth()]);

      }

    </script>
@endpush

