function collapse() {
  var coll = document.getElementsByClassName("collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.maxHeight){
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });
  };
};

collapse();

window.onload=getView();

function getView() {

  var url = "../../controller/controllerView.php";

  fetch(url, {
  method: 'GET',
  headers:{'Content-Type': 'application/json'}
  
  }).then(res => res.json()).then(result => {
    loadContent(result)
  }).catch(error => console.error('Error status:', error));
}
  
async function loadContent(x) {

  var accion = x;
  var data = {"accion":accion};
  var url = "../../controller/controllerPaciente.php";
  var sesion = await getSession();
  
  console.log(sesion);

  if (sesion.usuario) {
    $(".paciente").hide();
    
    $("#navbarDarkDropdownMenuLink").html(sesion.usuario);
  }else{
    $(".admin").hide();

    fetch(url, {
      method: 'POST',
      body: JSON.stringify(data),
      headers:{'Content-Type': 'application/json'}
      
    }).then(res => res.json()).then(result => {
      console.log("loginIñigo");
      console.log(result);

      $("#navbarDarkDropdownMenuLink").html(result.paciente.nombre + ', ' + result.paciente.apellido);
      $(".inputNombre").html(result.paciente.nombre);
      $(".inputApellido").html(result.paciente.apellido);

      
      // $("#tis").val(result.paciente.tis);
      // $("#localidad").val(result.paciente.centro.provincia);
      // $("#centro").val(result.paciente.centro.nombre);
      // $("#idCentro").val(result.paciente.centro.id);
      $("#dosis").val(parseInt(result.paciente.ultimaDosis) + 1);

      id_cita = result.paciente.citas[0].id;
      
      result.paciente.citas.forEach(element => {
        $("#divConsultarCitas").append("<br><button type='button' class='collapsible'>Cita "+element.dosis+"ª dosis </button>"
        +"<div class='cita'>"
        +  "<form>"
        +    "<div class='mb-3'>"
        +      "<label for='localidad' class='form-label'>Provincia:</label>"
        +      "<input type='text' class='form-control' placeholder='Localidad' disabled>"
        +    "</div>"
        +    "<div class='mb-3'>" 
        +        "<label for='centro' class='form-label'>Centro:</label>"
        +        "<input type='text' class='form-control' placeholder='"+result.paciente.centro.nombre+"' disabled>"
        +    "</div>"
        +    "<div class='mb-3'>"
        +        "<label class='form-label' for='fechaHora'>Fecha y Hora:</label><br>"
        +        "<input type='' name='enable' class='fechaHora form-control' id='fechaConsultarCita' value='"+element.fecha+" 'disabled>"
        +    "</div> <br>"
        +    "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#anularCita'>Anular Cita</button>"
        +    "<button type='button' class='btn btn-primary mx-3' data-bs-toggle='modal' data-bs-target='#modificarCita' onclick='enableModify()'>Cambiar fecha / hora</button>"
        +    "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#confirmarCitaCita' onclick='disableModify()'>Aceptar</button>"
        +  "</form>"
        +"</div>")
      });
      collapse();
      
      $(".inputTis").val(result.paciente.tis);
      $(".inputNombre").val(result.paciente.nombre);
      $(".inputApellido").val(result.paciente.apellido);
      $(".inputProvincia").val(result.paciente.centro.provincia);
      $(".inputNac").val(result.paciente.fecha_nac);
      $(".inputCentro").val(result.paciente.centro.nombre + ", " + result.paciente.centro.poblacion);
        
    }).catch(error => console.error('Error status:', error));
  }
}

$('#ConfirmarPedirCita').click(() => {
  console.log("Se ha clicado en ConfirmarPedirCita");
  pedirCita();
});


function pedirCita () {

  console.log("Se ha entrado en la funcion pedirCita")

  var tis = $('#tis').val();
  var dosis = $('#dosis').val();
  var fechaYhora = $('#fechaPedirCita').val();
  var idCentro = $('#idCentro').val();

  console.log(tis);
  console.log(dosis);
  console.log(fechaYhora);
  console.log(idCentro);

  var url = "../../controller/controllerCita.php";
  
  var data = { 'tis':tis, 'dosis':dosis, 'fechaYhora':fechaYhora, "idCentro":idCentro};

  fetch(url, {
  method: 'POST', // or 'POST'
  body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{'Content-Type': 'application/json'}  //input data
  
  })
  .then(res => res.json()).then(result => {
  
    console.log( "Se ha creado la cita correctamente?: "+result.added);

    if (result.added) {
      console.log("Cita creada correctamente");
    }

  }).catch(error => console.error('Error status:', error));

}

//activar y desactivar la funcion "Disabled"
function enableModify() {
$("input[name='enable']").prop('disabled', false);
$("select[name='enable']").prop('disabled', false);
$("button[name='disable']").prop('disabled', true);
}

function disableModify() {
  $("input[name='enable']").prop('disabled', true);
  $("select[name='enable']").prop('disabled', true);
  $("button[name='disable']").prop('disabled', false);
}

$('#btnCita').click(function () {
  var fechaCitaNueva = $('#fechaPedirCita').val().split('T')[0];
  var horaCitaNueva = $('#fechaPedirCita').val().split('T')[1]; 
  console.log("fecha: "+ fechaCitaNueva);
  console.log("hora: " + horaCitaNueva);
  
});

$('#historial').ready(()=>{
  historialVacu()
})

async function historialVacu() {
  var sesion = await getSession();
  var data = {'tis':sesion.tis};
  var url = '../../controller/controllerHistorial.php'

  fetch(url,{
    method:'POST',
    body: JSON.stringify(data),
    headers:{'Content-Type': 'application/json'}
  }).then(res => res.json()).then(result =>{
    console.log(result.historial);

    i = 0;
    e = 1;
    while (i < result.historial.length) {
      $('#historialVacunacion').append(
        "<button type='button' class='collapsible active'>Vacunacion "+e+"</button>"+
        "<div class='cita row mt-3'>"+
          "<div class='col-6 mb-4'>"+
            "<label for='tis' class='form-label'>Tis:</label>"+
            "<input type='text' class='form-control' placeholder='"+result.historial[i].tis+"' disabled>"+
            "<label for='Vacuna' class='form-label'>Vacuna:</label>"+
            "<input type='text' class='form-control' placeholder='"+result.historial[i].objVacuna.marca+"' disabled>"+
          "</div>"+
          "<div class='col-6 mb-4'>"+
            "<label for='Fecha' class='form-label'>Fecha:</label>"+
            "<input type='date' class='form-control' value='"+result.historial[i].fecha+"' disabled>"+
            "<label for='Dosis' class='form-label'>Dosis:</label>"+
            "<input type='text' class='form-control' placeholder='"+result.historial[i].dosis+"' disabled>"+
          "</div>"+
        "</div>"
      );

      i++;
      e++;
    }
    
  })
}

function getSession() { //RECOGE LAS VARIABLES DE SESSION

  return new Promise((resolve, reject) => {
    var  url = "../../controller/controllerSession.php";
    fetch(url, {
      method: "GET",
      headers:{'Content-Type': 'application/json'}
      }).then(res => res.json()).then(result => {
        resolve(result['SESSION']);
      }).catch(error => console.error('Error status:', error));
    
  })
}

$('#anularCita').click(()=>{

  var data = {'idCita': id_cita};
  var url = '../../controller/controllerCitaAnu.php';

  fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
    headers:{'Content-Type': 'application/json'}
  }).then(res => res.json()).then(result => {

    console.log(result.error);
    
  }).catch(error => console.error('Error status:', error));
})