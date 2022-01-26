var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;

    if(content.style.maxHeight){
      content.style.maxHeight = null;
    }
    else {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
};

window.onload=getView();

function getView() {

  var url = "../../controller/controllerView.php";

  fetch(url, {
  method: 'GET', // or 'POST'
  headers:{'Content-Type': 'application/json'}  //input data
  
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
      method: 'POST', // or 'POST'
      body: JSON.stringify(data), // data can be `string` or {object}!
      headers:{'Content-Type': 'application/json'}  //input data
      
    }).then(res => res.json()).then(result => {
      console.log(result.paciente);
      $("#navbarDarkDropdownMenuLink").html(result.paciente.nombre + ', ' + result.paciente.apellido);
      // $(".nombreYApePaciente").val(result.paciente.nombre +", "+result.paciente.apellido);
      $(".inputTis").val(result.paciente.tis);
      $(".inputNombre").val(result.paciente.nombre);
      $(".inputApellido").val(result.paciente.apellido);
      $(".inputProvincia").val(result.paciente.centro.provincia);
      $(".inputNac").val(result.paciente.fecha_nac);
      $(".inputCentro").val(result.paciente.centro.nombre + ", " + result.paciente.centro.poblacion);
        
    }).catch(error => console.error('Error status:', error));
  }
}

//activar y desactivar la funcion "Disabled"
function enableModify() {
$("input[name='enable']").prop('disabled', false);
$("select[name='enable']").prop('disabled', false);
}

function disableModify() {
  $("input[name='enable']").prop('disabled', true);
  $("select[name='enable']").prop('disabled', true);
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

$('#btnCita').click(function () {
  var fechaCitaNueva = $('#fechaPedirCita').val().split('T')[0];
  var horaCitaNueva = $('#fechaPedirCita').val().split('T')[1]; 
  console.log("fecha: "+ fechaCitaNueva);
  console.log("hora: " + horaCitaNueva);
  
});





// ! MOSTRAR LA CITA DEL PACIENTE TODAS LAS QUE TENGA

// $(document).ready(function () {

//   fetch(url,{
//     method: "GET",
//     headers:{'Content-Type': 'application/json'}
//   }).then(res => res.json()).then(result =>{

//     $('#citasPaciente').append(
//       "<form>"+
//         "<div class='mb-3'>" +
//           "<label for='localidad' class='form-label'>Provincia:</label>" +
//           "<input type='text' class='form-control' placeholder='Localidad' disabled>" +
//         "</div>" +
      
//         "<div class='mb-3'>" +
//           "<label for='centro' class='form-label'>Centro:</label>" +
//           "<input type='text' class='form-control' placeholder='Centro' disabled>" +
//         "</div>" +
      
//       "<div class='mb-3'>" +
//         "<label for='tipoDosis' class='form-label'>Vacuna:</label>" +
//         "<input type='text' class='form-control' placeholder='Vacuna' disabled>" +
//       "</div>" +
      
//       "<div class='mb-3'>" +
//         "<label for='dosis' class='form-label'>Nº Dosis:</label>" +
//         "<input type='text' class='form-control' placeholder='Dosis' disabled>" +
//       "</div>" +
  
//       "<div class='mb-3'> " +
//         "<label class='form-label' for='fechaHora'>Fecha y Hora:</label><br>" +
//         "<input name='enable' type='datetime-local' class='fechaHora' id='fechaConsultarCita' disabled>" +
//       "</div> <br>" +
      
//       "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#anularCita'>Anular Cita</button>" +
//       "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modificarCita' onclick='enableModify()'>Cambiar fecha / hora</button>" +
//       "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#confirmarCitaCita' onclick='disableModify()'>Aceptar</button>" +
//     "</form>");

//   })

    
// });
