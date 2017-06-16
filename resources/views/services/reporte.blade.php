@extends('layouts.principal')
@section('contenido')
<div class="row x_title">
  <div class="col-md-6">
    <h3>Reporte de ventas</h3>
  </div>
</div>
<div class="row" id="contenedorPrincipal">
  <div class="col-md-12">
    <canvas id="chartPedidos" style="width: 200px; height: 200px;"></canvas>                         
  </div>
  <div class="col-md-2 col-sm-2 col-xs-2" style="float: right;">
    <input type="button" id="btnExport" class="btn btn-info" value="Salvar como imagen">
  </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js" integrity="sha256-SiHXR50l06UwJvHhFY4e5vzwq75vEHH+8fFNpkXePr0=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function(){
    establecerConexion();
    crearGrafico();
  });
</script>
@endpush

@push('scriptsDown')
<script type="text/javascript">
  $('#fechaFiltro').daterangepicker({
    locale: {
    format: 'DD/MM/YYYY'
    }
  });

  $('#btnExport').click(function(){
    $('#chartPedidos').get(0).toBlob(function(blob){
      saveAs(blob, 'chart.png')
    });
  });
</script>
<script src="https://fastcdn.org/FileSaver.js/1.1.20151003/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/javascript-canvas-to-blob/3.7.0/js/canvas-to-blob.min.js"></script>
@endpush

