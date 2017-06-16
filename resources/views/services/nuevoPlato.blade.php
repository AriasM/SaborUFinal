@extends('layouts.principal')
@section('contenido')
<div class="row x_title">
  <div class="col-md-6">
    <h3>Agregar Plato</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class=" col-md-6 col-sm-6 col-xs-6">
      <h2>Opcional:</h2>
      <div class="radio">
        <label><input type="radio" name="brTipoPlato" id="brPlatoOpcional" value="true">Sí</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="brTipoPlato" id="brPlatoNoOpcional" value="false">No</label>
      </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
      <h2>Precio:</h2>
      <div class="col-md-4 col-sm-4 col-xs-4 form-group">
        <input type="number" class="form-control" id="precioPlato" min="0">
      </div>
    </div>            
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <h2>Tiempo de Comida:</h2>
      <div class="radio">
        <label><input type="radio" name="brTiempoComida" id="brDesayuno" value="desayuno">Desayuno</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="brTiempoComida" id="brAlmuerzo" value="almuerzo">Almuerzo</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="brTiempoComida" id="brCena" value="cena">Cena</label>
      </div>            
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
      <h2>Nombre del plato:</h2>
      <div class="col-md-4 col-sm-4 col-xs-4 form-group">
        <input type="text" class="form-control" id="nombrePlato" min="0">
      </div>
    </div>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <h2>Día:</h2>
      <div class="col-md-4 col-sm-4 col-xs-4 form-group">
        <select class="form-control" id="selDia" name="dia">
          <option value="1">Lunes</option>
          <option value="2">Martes</option>
          <option value="3">Miércoles</option>
          <option value="4">Jueves</option>
          <option value="5">Viernes</option>
          <option value="6">Sábado</option>
        </select>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
      <h2>Semana:</h2>
      <div class="col-md-4 col-sm-4 col-xs-4 form-group">
        <select class="form-control" id="selSemana" name="semana">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
    </div>          
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <h2>Componentes:</h2>
      <div class="control-group">
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input id="tags_1" type="text" class="tags form-control"/>
          <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <input  value="Agregar"  class="btn btn-success" onclick="obtenerDatos()" type="submit">
      <button type="button" class="btn btn-danger">Cancelar</button>
    </div>
  </div>
</div><br>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="alert alert-success" role="alert" style="visibility: hidden" id="alertExito"><strong>¡Éxito!</strong> Plato agregado correctamente.</div>
  </div>          
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="alert alert-danger" role="alert" style="visibility: hidden" id="alertError"><strong>Error!</strong> Faltan datos de completar.</div>
  </div>          
</div>
@endsection
@push('scriptsDown')
<script>
      function datosValidos(){
        var precioPlato = document.getElementById('precioPlato');
        var nombrePlato = document.getElementById('nombrePlato');
        var tipoPlato = document.getElementsByName('brTipoPlato');
        var tiempoComida = document.getElementsByName('brTiempoComida');
        var componentes = document.getElementById("tags_1");
        var isValid = true;
        if(precioPlato.value == ""){
            isValid = false;
            precioPlato.style.borderColor = "#FD0505";
        }
        else{
            precioPlato.style.borderColor = "#FFFFFF"; 
        }
        if(nombrePlato.value == ""){
            isValid = false;
            nombrePlato.style.borderColor = "#FD0505";
        }
        else{
            nombrePlato.style.borderColor = "#FFFFFF"; 
        }
        if(!(tipoPlato[0].checked ==true || tipoPlato[1].checked == true)){
          isValid = false;
        }
        if(!(tiempoComida[0].checked ==true || tiempoComida[1].checked ==true || tiempoComida[2].checked ==true)){
          isValid = false;
        }
        if(componentes.value == ""){
          isValid = false;
          componentes.style.borderColor = "red";
        }
        else{
          componentes.style.borderColor = "#FFFFFF";
        }

        return isValid;
      }

      function limpiarDatos(){

        var brTiposPlato = document.getElementsByName("brTipoPlato");
        for(var i=0;i<brTiposPlato.length;i++){
          brTiposPlato[i].checked = false;
        }

        document.getElementById("precioPlato").value = "";

        var brTiemposComida = document.getElementsByName("brTiempoComida");
        for(var i=0;i<brTiemposComida.length;i++){
          brTiemposComida[i].checked = false;
        }

        document.getElementById('tags_1').value = "";
        //


      }

      function obtenerDatos(){
        function Dia(numeroDia){
          this.numeroDia = numeroDia;
        }

        function Semana(numeroSemana){
          this.numeroSemana = numeroSemana;
        }

        function TiempoDeComida(nombreTiempoDeComida){
          this.nombreTiempoDeComida = nombreTiempoDeComida;
        }

        function Plato(dia, items, nombrePlato, opcional, semana, precio, tiempoComida){
          this.dia = dia;
          this.items = items;
          this.nombrePlato = nombrePlato;
          this.opcional = opcional;
          this.semana = semana;
          this.precioPlato = precio;
          this.tiempoDeComida = tiempoComida;
        }

        function Componentes(nombreComponente){
          this.nombreComponentePlato = nombreComponente;
        }

        function Items(componentes){
          this.componente = componentes;
        }

        var opcional = "";
        var precio = document.getElementById('precioPlato').value;
        var tiempoComida = "";
        var dia = document.getElementById('selDia').value;
        var semana = document.getElementById('selSemana').value;
        var brPlatoOpc = document.getElementById('brPlatoOpcional');
        var brDesayuno = document.getElementById('brDesayuno');
        var brAlmuerzo = document.getElementById('brAlmuerzo');
        var componentes = document.getElementById('tags_1').value;
        var components = componentes.split(",");
        var items = new Array();


        if(brPlatoOpc.checked){
          opcional = true;
        }
        else{
          opcional = false;
        }

        if (brDesayuno.checked) {
          tiempoComida = brDesayuno.value;
        }
        else if(brAlmuerzo.checked){
          tiempoComida = brAlmuerzo.value;
        }
        else{
          tiempoComida = brCena.value;
        }

        for (var i = 0; i < components.length; i++) {
            var componenteAux = new Componentes(components[i]);
            var item = new Items(componenteAux);
            items[i] = item;
        }
        
        var dia = new Dia(parseInt(dia));
        var semana = new Semana(parseInt(semana));
        var tiempoComida = new TiempoDeComida(tiempoComida);
        var plato = new Plato(dia, items, nombrePlato.value, opcional, semana, parseFloat(precio),tiempoComida);

        if(datosValidos()){
          salvarPlato(plato);
          document.getElementById("alertExito").style.visibility = "visible";
          limpiarDatos();
          setTimeout("location.reload()", 8000);
        }
        else{
          document.getElementById("alertError").style.visibility = "visible";
        }
}
</script>

@endpush

