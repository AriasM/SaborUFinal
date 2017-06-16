 // src="https://www.gstatic.com/firebasejs/3.4.0/firebase.js"
 src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"

function establecerConexion(){
    var config = {
    apiKey: "AIzaSyAKdweiacwRtC4-IfvON-RASEc22UJ5D_g",
    authDomain: "pedi-tu-almuerzo-c34ef.firebaseio.com",
    databaseURL: "https://pedi-tu-almuerzo-c34ef.firebaseio.com",
    projectId: " pedi-tu-almuerzo-c34ef",
    storageBucket: "pedi-tu-almuerzo-c34ef.appspot.com",
    messagingSenderId: "848893801760"
    };
    firebase.initializeApp(config);
}


function salvarPlato(plato){
    establecerConexion();
    firebase.database().ref('Platos').push(plato);
}

function obtenerPlatos(){
    establecerConexion();

    var referencia = firebase.database().ref("Platos");
    var platos = {};

    referencia.on('value', function(datos){

        platos = datos.val();

        $.each(platos, function(indice, valor){
            $(".selectPlatos select").append('<option value="'+indice+'">'+valor.nombrePlato+'</option>');
        });

    }, function(objetoError){
        alert(objetoError.code);
    });

}

function cargarDatosPlato(idPlato){

    var referencia = firebase.database().ref("Platos/"+idPlato);
    var plato = new Object();
    var componentes = "";

    referencia.on('value', function(datos){
        plato = datos.val();

        if(plato.opcional){
            $('#brPlatoOpcional').prop('checked', true);
        }
        else{
            $('#brPlatoNoOpcional').prop('checked', true);
        }

        $('#precioPlato').val(plato.precioPlato);
        $('#nombrePlato').val(plato.nombrePlato);

        switch(plato.tiempoDeComida.nombreTiempoDeComida){
            case 'desayuno':
                $('#brDesayuno').prop('checked', true);
                break;
            case 'almuerzo':
                $('#brAlmuerzo').prop('checked', true);       
                break;
            case 'cena':
                $('#brCena').prop('checked', true);
                break;
        }

        $('.selectDias option[value="'+plato.dia.numeroDia+'"]').prop('selected', 'selected');
        $('.selectSemana option[value="'+plato.semana.numeroSemana+'"]').prop('selected', 'selected');

        

        $.each(plato.items, function(indice, valor){
            var componente = new Object();
            componente = valor.componente;
            if(indice<plato.items.length-1){
                componentes += componente.nombreComponentePlato + ", ";    
            }else{
                componentes += componente.nombreComponentePlato;
            }
            
        });
        //
        $.fn.tagsInput.importTags('#tags_1', componentes);

        document.getElementById("contenedorPrincipal").style.visibility = "visible";
        
        });
}

function modificarPlato(plato, idPlato){
    firebase.database().ref('Platos/'+idPlato).update(plato);
}

function eliminarPlato(idPlato){

    var confirmar = confirm("¿Desea eliminar el plato seleccionado?");

    if(confirmar){
        firebase.database().ref('Platos/'+idPlato).remove();
        setTimeout("location.reload()", 2000);    
    }

}

function cargarPlatosTablas(){
    establecerConexion();

    var referencia = firebase.database().ref("Platos");
    var platos = {};

    referencia.on('value', function(datos){

        platos = datos.val();

        $.each(platos, function(indice, valor){
            
            switch(valor.semana.numeroSemana){
                case 1:
                    cargarDatosTablas(1, valor);
                break;
                case 2:
                    cargarDatosTablas(2, valor);
                break;
                case 3:
                    cargarDatosTablas(3, valor);
                break;
            }
        });

    }, function(objetoError){
        alert(objetoError.code);
    });
}

function cargarDatosTablas(semana, plato){
    switch(plato.dia.numeroDia){
        case 1:
            $('#tdS'+semana+'D1').html('<button type="button" class="btn btn-info btn-link" data-toggle="modal" data-target="#descripcionPlato">'+plato.nombrePlato+'</button>');
        break;
        case 2:
            $('#tdS'+semana+'D2').html('<button type="button" class="btn btn-info btn-link" data-toggle="modal" data-target="#descripcionPlato">'+plato.nombrePlato+'</button>');
        break;
        case 3:
            $('#tdS'+semana+'D3').html('<button type="button" class="btn btn-info btn-link" data-toggle="modal" data-target="#descripcionPlato">'+plato.nombrePlato+'</button>');
        break;
        case 4:
            $('#tdS'+semana+'D4').html('<button type="button" class="btn btn-info btn-link" data-toggle="modal" data-target="#descripcionPlato">'+plato.nombrePlato+'</button>');
        break;
        case 5:
            $('#tdS'+semana+'D5').html('<button type="button" class="btn btn-info btn-link" data-toggle="modal" data-target="#descripcionPlato">'+plato.nombrePlato+'</button>');
        break;
        case 6:
            $('#tdS'+semana+'D6').html('<button type="button" class="btn btn-info btn-link" data-toggle="modal" data-target="#descripcionPlato">'+plato.nombrePlato+'</button>');
        break;
    }
}

function cargarPlatosOpcionales(){
    var referencia = firebase.database().ref("Platos");
    var platos = {};

    referencia.on('value', function(datos){

        platos = datos.val();

        $.each(platos, function(indice, valor){

            if(valor.opcional){
                $(".selectPlatosOpcionales select").append('<option value="'+indice+'">'+valor.nombrePlato+'</option>');    
            }
            
        });

    }, function(objetoError){
        alert(objetoError.code);
    });
}

function asignarPlatoOpcionalDia(){
    var idPlato = $('#selPlatoOpcional').val();
    var platoOpcional = {platoOpcional: idPlato
                        }

    firebase.database().ref('control').update(platoOpcional);
    $('#alertExito').css('visibility', 'visible');
}

function cargarPedidosTablas(){
    establecerConexion();

    var referencia = firebase.database().ref("Pedidos");
    var pedidos = {};
    var contPendiente = 0;
    var contEntregado = 0;

    referencia.on('value', function(datos){

        pedidos = datos.val();
        document.getElementById("tablita").innerHTML = "";
        document.getElementById("tablita2").innerHTML = "";
        contPendiente = 0;
        contEntregado = 0;

        $.each(pedidos, function(indice, valor){
            
            switch(valor.estado){
                case "Pendiente":
                    contPendiente+=1;
                    cargarDatos(1, valor, indice);
                break;
                case "Entregado":
                    contEntregado+=1;
                    cargarDatos(2, valor, indice);
                break;
            }

            var lbTotalPedidos = document.getElementById('lbTotalPedidos');
            lbTotalPedidos.innerHTML = contEntregado+contPendiente;

            var lbEntregado = document.getElementById('lbEntregado');
            lbEntregado.innerHTML = contEntregado;

            var lbPendiente = document.getElementById('lbPendiente');
            lbPendiente.innerHTML = contPendiente;
        });

    }, function(objetoError){
        alert(objetoError.code);
    });
}

function cargarDatos(estado, pedido, idPedido){

    switch(estado){
        case 1:
            var boton = '<button type="button" class="btn btn-info btn-link">Entregar</button>';
            var fila="<tr><td>"+idPedido+"</td><td>"+pedido.items[0].plato.nombrePlato+"</td><td>"+pedido.items[0].cantidad+"</td><td>"+pedido.usuario.nombreUsuario+"</td><td>"+pedido.estado+"</td><td>"+boton+"</td></tr>";
            var btn = document.createElement("TR");
            btn.innerHTML=fila;
            document.getElementById("tablita").appendChild(btn);
            $('#tablita tr').on('click', function(){
              var dato = $(this).find('td:first').html();
              obtenerPedido(dato);
            });
            break;

            case 2:
                var boton = '<button type="button" class="btn btn-info btn-link">Listo</button>';
                var fila="<tr><td>"+idPedido+"</td><td>"+pedido.items[0].plato.nombrePlato+"</td><td>"+pedido.items[0].cantidad+"</td><td>"+pedido.usuario.nombreUsuario+"</td><td>"+pedido.estado+"</td><td>"+boton+"</td></tr>";
                var btn = document.createElement("TR");
                btn.innerHTML=fila;
                document.getElementById("tablita2").appendChild(btn);
                break;
    }
}

function obtenerPedido(idPedido){

    var referencia = firebase.database().ref("Pedidos/"+idPedido);
    var pedido = new Object();

    referencia.on('value', function(datos){

        pedido = datos.val();
        actualizarPedido(idPedido, pedido);

    }, function(objetoError){
        alert(objetoError.code);
    });

}
function actualizarPedido(idPedido, pedido){

    switch(pedido.estado){
        case "Pendiente":
            pedido.estado = "Entregado";   
            break;
    }

    firebase.database().ref("Pedidos/"+idPedido).update(pedido);

}

function cargarDatosHistorial(){

    var referencia = firebase.database().ref("Pedidos");
    var pedidos = {};

    referencia.on('value', function(datos){

        pedidos = datos.val();
        $('#tbPedidos tr').remove();

        $.each(pedidos, function(indice, valor){

            for (var i = 0; i < valor.items.length; i++) {
                var nuevaFila = "<tr><td>"+valor.items[i].plato.nombrePlato+"</td><td>"+valor.items[i].cantidad+"</td><td>"+valor.usuario.nombreUsuario+"</td><td>"+valor.items[i].comentarios+"</td><td>"+valor.estado+"</td><td>"+valor.fechaPedido+"</td></tr>";
                $('#tbPedidos').append(nuevaFila);
            }
            
        });

    }, function(objetoError){
        alert(objetoError.code);
    });
}

function filtrarHistorial(){
    var fecha = $('#fechaFiltro').val();
    var fechas = fecha.split(' -');
    var referencia = firebase.database().ref("Pedidos");
    var pedidos = {};
    var parseFechaInicio = fechas[0].split('/');
    var parseFechaFin = fechas[1].split('/');
    var fechaInicio = new Date(parseFechaInicio[2], parseFechaInicio[1], parseFechaInicio[0]);
    var fechaFin = new Date(parseFechaFin[2], parseFechaFin[1], parseFechaFin[0]);

    referencia.on('value', function(datos){

        pedidos = datos.val();
        $('#tbPedidos tr').remove();

        $.each(pedidos, function(indice, valor){

            for (var i = 0; i < valor.items.length; i++) {
                var parseFechaPedido = valor.fechaPedido.split('/');
                var fechaPedido = new Date(parseFechaPedido[2], parseFechaPedido[1], parseFechaPedido[0]);

                if (fechaInicio < fechaPedido && fechaFin > fechaPedido) {
                    var nuevaFila = "<tr><td>"+valor.items[i].plato.nombrePlato+"</td><td>"+valor.items[i].cantidad+"</td><td>"+valor.usuario.nombreUsuario+"</td><td>"+valor.items[i].comentarios+"</td><td>"+valor.estado+"</td><td>"+valor.fechaPedido+"</td></tr>";
                    $('#tbPedidos').append(nuevaFila);
                }

            }
            
        });

    }, function(objetoError){
        alert(objetoError.code);
    });
}

function crearGrafico(){
    var cantidadPedidosOpcional = new Array();
    getArrayPedidosPorPlato();

    var pedidosPrincipal = JSON.parse(sessionStorage.getItem("pedidosPlatoPrincipal"));
    var pedidosOpcional = JSON.parse(sessionStorage.getItem("pedidosPlatoOpcional"));
    var cantidadPedidosPrincipal = obtenerNumeroVentasPlato(pedidosPrincipal);
    var cantidadPedidosOpcional = obtenerNumeroVentasPlato(pedidosOpcional);

    var datos = {
        labels : ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        datasets : [{
            label : "Plato principal",
            backgroundColor : "rgba(220,220,220,0.5)",
            data : cantidadPedidosPrincipal
        },
        {
            label : "Plato opcional",
            backgroundColor : "rgba(151,187,205,0.5)",
            data : cantidadPedidosOpcional
        }
        ]
    };

    var canvas = document.getElementById('chartPedidos').getContext('2d');

    window.bar = new Chart(canvas, {
        type : "line",
        data : datos,
        options : {
            responsive : true,
            scaleShowLabels: true,
            title : {
                display : true,
                text : "Ventas realizadas mediante pedidos"
            },
        }
    });
}

function getArrayPedidosPorPlato(){
    var referencia = firebase.database().ref("Pedidos");
    var pedidos = {};
    var pedidosPlatoPrincipal = new Array();
    var pedidosPlatoOpcional = new Array();
    var index = 0;
    var indexOp = 0;

    referencia.on('value', function(datos){

        pedidos = datos.val();

        $.each(pedidos, function(indice, valor){
            var plato = valor.items[0].plato;

            if(! plato.opcional){
                pedidosPlatoPrincipal[index] = valor;
                index++;
            }else{
                pedidosPlatoOpcional[indexOp] = valor;
                indexOp++;
            }
            
        });

        if(!sessionStorage.pedidosPlatoPrincipal){
            sessionStorage.setItem("pedidosPlatoPrincipal", JSON.stringify(pedidosPlatoPrincipal));
        }
        if (! sessionStorage.pedidosPlatoOpcional) {
            sessionStorage.setItem("pedidosPlatoOpcional", JSON.stringify(pedidosPlatoOpcional));    
        }
        

    }, function(objetoError){
        alert(objetoError.code);
    });

    
}

function obtenerNumeroVentasPlato(pedidos){
    var cantidadVentasMes = [0,0,0,0,0,0,0,0,0,0,0,0];

    if(pedidos.length > 0){
        for (var i = 0; i < pedidos.length; i++) {
            var fecha = pedidos[i].fechaPedido.split('/');

            switch(fecha[1]){
                case "01":
                    cantidadVentasMes[0] = cantidadVentasMes[0]+1;
                break;
                case "02":
                    cantidadVentasMes[1] = cantidadVentasMes[1]+1;
                break;
                case "03":
                    cantidadVentasMes[2] = cantidadVentasMes[2]+1;
                break;
                case "04":
                    cantidadVentasMes[3] = cantidadVentasMes[3]+1;
                break;
                case "05":
                    cantidadVentasMes[4] = cantidadVentasMes[4]+1;
                break;
                case "06":
                    cantidadVentasMes[5] = cantidadVentasMes[5]+1;
                break;
                case "07":
                    cantidadVentasMes[6] = cantidadVentasMes[6]+1;
                break;
                case "08":
                    cantidadVentasMes[7] = cantidadVentasMes[7]+1;
                break;
                case "09":
                    cantidadVentasMes[8] = cantidadVentasMes[8]+1;
                break;
                case "10":
                    cantidadVentasMes[9] = cantidadVentasMes[9]+1;
                break;
                case "11":
                    cantidadVentasMes[10] = cantidadVentasMes[10]+1;
                break;  
                case "12":
                    cantidadVentasMes[11] = cantidadVentasMes[11]+1;
                break;

            }
        }
    }

    return cantidadVentasMes;
}



