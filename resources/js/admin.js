$(document).ready(function() {
    var url = "../../controller/controllerCentros.php";
    console.log("centros");
    fetch(url, {
        method: 'POST',
        headers:{'Content-Type': 'application/json'}
        
      }).then(res => res.json()).then(result => {
        var centros = result.centros;

        var vizcaya = "";
        var gipuzkoa = "";
        var navarra = "";
        
        $(centros).each(function(i) {
            if(centros[i].provincia.includes("Vizcaya")){
                vizcaya += "<button type='button' class='collapsible-no-back centroM' data-bs-toggle='modal' data-bs-target='#dataCentro' "
                + "data-id='" + centros[i].id + "' "
                + "data-nombre='" + centros[i].nombre + "' "
                + "data-poblacion='" + centros[i].poblacion + "' "
                + "data-cp='" + centros[i].cp + "' "
                + "data-provincia='" + centros[i].provincia + "' "
                + "data-direccion='" + centros[i].direccion + "' "
                + "data-lunes='" + centros[i].lunes + "' "
                + "data-martes='" + centros[i].martes + "' "
                + "data-miercoles='" + centros[i].miercoles + "' "
                + "data-jueves='" + centros[i].jueves + "' "
                + "data-viernes='" + centros[i].viernes + "' "
                + "data-sabado='" + centros[i].sabado + "' "
                + "data-domingo='" + centros[i].domingo + "' "
                + "data-hora_apertura='" + centros[i].hora_apertura + "' "
                + "data-hora_cierre='" + centros[i].hora_cierre + "' "
                + ">" + centros[i].nombre + "</button>";
            }
            else if(centros[i].provincia.includes("Gipuzkoa")){
                gipuzkoa += "<button type='button' class='collapsible-no-back centroM' data-bs-toggle='modal' data-bs-target='#dataCentro'>" + centros[i].nombre + "</button>";
            }
            else if(centros[i].provincia.includes("Navarra")){
                navarra += "<button type='button' class='collapsible-no-back centroM' data-bs-toggle='modal' data-bs-target='#dataCentro'>" + centros[i].nombre + "</button>";
            }
        });
        
        $('#vizcaya').append(vizcaya);
        $('#gipuzkoa').append(gipuzkoa);
        $('#navarra').append(navarra);

        $('.centroM').click(function log() {
            var data = $(this).data();
            console.log(data);
            $("#centroNombre").val(data.nombre);
            $("#centroProvincia").val(data.provincia);
            $("#centroPoblacion").val(data.poblacion);
            $("#centroDireccion").val(data.direccion);
            $("#centroCP").val(data.cp);
            $("#centroApertura").val(data.hora_apertura);
            $("#centroCierre").val(data.hora_cierre);

            $("#centroLunes").val(data.lunes);
            $("#centroMartes").val(data.martes);
            $("#centroMiercoles").val(data.miercoles);
            $("#centroJueves").val(data.jueves);
            $("#centroViernes").val(data.viernes);
            $("#centroSabado").val(data.sabado);
            $("#centroDomingo").val(data.domingo);
        });
      }).catch(error => console.error('Error status:', error));
});

$('#crearCentro').click(function log() {
    var nombre = $("#crearNombre").val();
    var provincia = $("#crearProvincia").val();
    var poblacion = $("#crearPoblacion").val();
    var direccion = $("#crearDireccion").val();
    var cp = $("#crearCP").val();
    var hora_apertura = $("#crearHora_aper").val();
    var hora_cierre = $("#crearHora_cerrar").val();
    var lunes = $("#crearLunes").val();
    var martes = $("#crearMartes").val();
    var miercoles = $("#crearMiercoles").val();
    var jueves = $("#crearJueves").val();
    var viernes = $("#crearViernes").val();
    var sabado = $("#crearSabado").val();
    var domingo = $("#crearDomingo").val();

    console.log("hora_apertura");
    console.log(hora_apertura);

    var data = {'nombre': nombre,'provincia': provincia,'poblacion': poblacion,'direccion': direccion,'cp': cp,'hora_apertura': hora_apertura,'hora_cierre': hora_cierre,'lunes': lunes,'martes': martes,'miercoles': miercoles,'jueves': jueves,'viernes': viernes,'sabado': sabado,'domingo': domingo};
    var url = '../../controller/controllerAnadirCentro.php';

    fetch(url, {
        method: 'POST', 
        body: JSON.stringify(data),
        headers:{'Content-Type': 'application/json'}  
    }).then(res => res.json()).then(result => {
        
        console.log(result);

        if (result.error == 'Centro añadido') {
            alert('Centro añadido con exito.')
        }

    }).catch(error => console.error('Error status:', error));
});

$('#buscaTis').click(function () { 
    var tisP = $('#numTis').val();
    var data = {'tis': tisP};
    var url = '../../controller/controllerFindPaciente.php';

    fetch(url, {
        method: 'POST', 
        body: JSON.stringify(data),
        headers:{'Content-Type': 'application/json'}  
    }).then(res => res.json()).then(result => {
        
        console.log(result);

        var fechaPcr = result.paciente.fecha_pcr_pstv;

        if (fechaPcr == null) {
            fechaPcr = 'NO TIENE FECHA';
        }

        $('#infoPaciente').html(
            "<div class='col-7'>" +
              "<label class='fw-bold'>Nombre del paciente:</label><span> "+result.paciente.nombre+"</span><br>" +
              "<label class='fw-bold'>Apellido del paciente: </label><span> "+result.paciente.apellido+"</span><br>" +
              "<label class='fw-bold'>fecha de nacimiento del paciente: </label><span> "+result.paciente.fecha_nac+"</span><br>" +
              "<label class='fw-bold'>Nombre del centro asignado del paciente: </label><span> "+result.paciente.centro.nombre+"</span><br>" +
              "<label class='fw-bold'>Poblacion del centro asignado del paciente: </label><span> "+result.paciente.centro.poblacion+"</span><br>" +
              "<label class='fw-bold'>Provincia del centro asignado del paciente: </label><span> "+result.paciente.centro.provincia+"</span><br>" +
            "</div>" +
            "<div class='col-5'>" +
              "<label class='fw-bold'>Ultima pcr positiva del paciente: </label><span> "+fechaPcr+"</span><br>" +
              "<label class='fw-bold'>Nº de dosis del paciente: </label><span> "+result.paciente.citas.dosis+"</span><br>" +
              "<label class='fw-bold'>Id de la cita del paciente: </label><span> "+result.paciente.citas.id+"</span><br>" +
              "<label class='fw-bold'>Fecha de la cita del paciente: </label><span> "+result.paciente.citas.fecha.split(" ")[0]+"</span><br>" +
              "<label class='fw-bold'>Hora de la cita del paciente: </label><span> "+result.paciente.citas.fecha.split(" ")[1]+" </span><br>" +
            "</div>"
        );

    }).catch(error => console.error('Error status:', error));

    $('#datosPaciente').html();
});

