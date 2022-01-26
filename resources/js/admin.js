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
            var myBookId = $(this).data();
            console.log(myBookId);
            //$(".modal-body #bookId").val(myBookId);
        });
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