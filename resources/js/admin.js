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
                console.log(centros[i]);
                vizcaya += "<button type='button' class='collapsible-no-back' data-bs-toggle='modal' data-bs-target='#dataCentro'>" + centros[i].nombre + "</button>";
            }
            else if(centros[i].provincia.includes("Gipuzkoa")){
                gipuzkoa += "<button type='button' class='collapsible-no-back' data-bs-toggle='modal' data-bs-target='#dataCentro'>" + centros[i].nombre + "</button>";
            }
            else if(centros[i].provincia.includes("Vizcaya")){
                navarra += "<button type='button' class='collapsible-no-back' data-bs-toggle='modal' data-bs-target='#dataCentro'>" + centros[i].nombre + "</button>";
            }
        });
        
        $('#vizcaya').append(vizcaya);
        $('#gipuzkoa').append(gipuzkoa);
        $('#navarra').append(navarra);
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

        

    }).catch(error => console.error('Error status:', error));

    $('#datosPaciente').html();
});