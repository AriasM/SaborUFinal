@extends('layouts.dep')
@section('contenido')
<div class="row x_title">
  <div class="col-md-6">
    <h3>Menú</h3>
  </div>
</div>
<div class="row" id="contenedorPrincipal">
  <div class="col-md-10 col-xs-10 col-sm-10">
    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    Semana 1</a>
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
          <div class="panel-body">
            <table class="table table-hover" id="tablaSemana1">
              <thead>
                <tr>
                  <th>Día</th>
                  <th>Plato del día</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Lunes</td>
                  <td id="tdS1D1"></td>
                </tr>
                <tr>
                  <td>Martes</td>
                  <td id="tdS1D2"></td>
                </tr>
                <tr>
                  <td>Miércoles</td>
                  <td id="tdS1D3"></td>
                </tr>
                <tr>
                  <td>Jueves</td>
                  <td id="tdS1D4"></td>
                </tr>
                <tr>
                  <td>Viernes</td>
                  <td id="tdS1D5"></td>
                </tr>
                <tr>
                  <td>Sábado</td>
                  <td id="tdS1D6"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                    Semana 2</a>
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
          <div class="panel-body">
            <table class="table table-hover" id="tablaSemana2">
              <thead>
                <tr>
                          <th>Día</th>
                          <th>Plato del día</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Lunes</td>
                          <td id="tdS2D1"></td>
                        </tr>
                        <tr>
                          <td>Martes</td>
                          <td id="tdS2D2"></td>
                        </tr>
                        <tr>
                          <td>Miércoles</td>
                          <td id="tdS2D3"></td>
                        </tr>
                        <tr>
                          <td>Jueves</td>
                          <td id="tdS2D4"></td>
                        </tr>
                        <tr>
                          <td>Viernes</td>
                          <td id="tdS2D5"></td>
                        </tr>
                        <tr>
                          <td>Sábado</td>
                          <td id="tdS2D6"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                   Semana 3</a>
                  </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                  <div class="panel-body">
                    <table class="table table-hover" id="tablaSemana3">
                      <thead>
                        <tr>
                          <th>Día</th>
                          <th>Plato del día</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Lunes</td>
                          <td id="tdS3D1"></td>
                        </tr>
                        <tr>
                          <td>Martes</td>
                          <td id="tdS3D2"></td>
                        </tr>
                        <tr>
                          <td>Miércoles</td>
                          <td id="tdS3D3"></td>
                        </tr>
                        <tr>
                          <td>Jueves</td>
                          <td id="tdS3D4"></td>
                        </tr>
                        <tr>
                          <td>Viernes</td>
                          <td id="tdS3D5"></td>
                        </tr>
                        <tr>
                          <td>Sábado</td>
                          <td id="tdS3D6"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div id="descripcionPlato" class="modal fade" role="dialog">
              <div class="modal-dialog">

              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Plato</h4>
                  </div>
                  <div class="modal-body">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    cargarPlatosTablas();
    cargarPlatosOpcionales();
  });
</script>
@endpush