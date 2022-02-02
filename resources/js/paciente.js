var savedFileBase64;

function collapse() {
  var coll = $(".collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });
  };
};

collapse();

window.onload = getView();

function getView() {

  var url = "../../controller/controllerView.php";

  fetch(url, {
    method: 'GET',
    headers: { 'Content-Type': 'application/json' }

  }).then(res => res.json()).then(result => {
    loadContent(result)
  }).catch(error => console.error('Error status:', error));
}

async function loadContent(x) {

  var accion = x;
  var data = { "accion": accion };
  var url = "../../controller/controllerPaciente.php";
  var sesion = await getSession();
  
  var pacienteButtons = "<p class='textoPaciente'>Puedes pedir una cita o consultar y editar tus citas pendientes. Tambien puedes anular una cita.</p>" +
                        "<button type='button' class='btn btn-outline-success paciente' data-bs-toggle='modal' data-bs-target='#pedirCita'>Pedir cita</button>" +
                        "<button type='button' class='btn btn-outline-danger paciente' data-bs-toggle='modal' data-bs-target='#consultarCita'>Consultar citas</button>" +
                        "<button type='button' class='btn btn-outline-success paciente' data-bs-toggle='modal' data-bs-target='#historial'>Historial de Vacunación</button>";

  var generalButtons = "<button type='button' class='btn btn-outline-danger admin adming' data-bs-toggle='modal'"+
                      "data-bs-target='#modificarCentros'>Modificar Centros</button>"+
                      "<button type='button' class='btn btn-outline-success admin adming' data-bs-toggle='modal'"+
                      "data-bs-target='#añadirCentros'>Añadir Centro</button>";

  var adminPacienteButtons = "<button type='button' class='btn btn-outline-danger admin' data-bs-toggle='modal' data-bs-target='#verPacientes'>Consultar Pacientes</button>";

  if (sesion.usuario) {

    if (sesion.tipo == "paciente") {
      $("#mainButtons").html(adminPacienteButtons);
    }else if(sesion.tipo == "general"){
      $("#mainButtons").html(generalButtons);
      $("#mainButtons").append(adminPacienteButtons);
    }

    $(".paciente").hide();

    $("#navbarDarkDropdownMenuLink").html(sesion.usuario);

  }else {
    //$(".admin").hide();
    $("#mainButtons").html(pacienteButtons);

    fetch(url, {
      method: 'POST',
      body: JSON.stringify(data),
      headers: { 'Content-Type': 'application/json' }

    }).then(res => res.json()).then(result => {

      $("#navbarDarkDropdownMenuLink").html(result.paciente.nombre + ', ' + result.paciente.apellido);
      $(".inputNombre").html(result.paciente.nombre);
      $(".inputApellido").html(result.paciente.apellido);
      $('#idCentro').val(result.paciente.centro.id)

      id_cita = result.paciente.citas[0].id;
      var i = 0;
      console.log(result);

      result.paciente.citas.forEach(element => {
        $("#divConsultarCitas").append("<br><button type='button' class='collapsible'>Cita " + element.dosis + "ª dosis </button>"
          + "<div class='cita'>"
          + "<form>"
          + "<div class='mb-3'>"
          + "<label fro='idCite' class='form-label mt-2'>ID de la cita:</label>"
          + "<input type='text' class='form-control mb-3' placeholder='" + result.paciente.citas[i].id + "' disabled>"
          + "<label for='localidad' class='form-label'>Población:</label>"
          + "<input type='text' class='form-control' placeholder='" + result.paciente.centro.poblacion + "' disabled>"
          + "</div>"
          + "<div class='mb-3'>"
          + "<label for='centro' class='form-label'>Centro:</label>"
          + "<input type='text' class='form-control' placeholder='" + result.paciente.centro.nombre + "' disabled>"
          + "</div>"
          + "<div class='mb-3'>"
          + "<label class='form-label' for='fechaHora'>Fecha y Hora:</label><br>"
          + "<input type='' name='enable' class='fechaHora form-control' id='fechaConsultarCita' value='" + element.fecha + " 'disabled>"
          + "</div>"
          + "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#anularCita'>Anular Cita</button>"
          + "</form>"
          + "</div>")
        i++;
      });
      collapse();

      $(".inputTis").val(result.paciente.tis);
      $(".inputNombre").val(result.paciente.nombre);
      $(".inputApellido").val(result.paciente.apellido);
      $(".inputProvincia").val(result.paciente.centro.provincia);
      $(".inputNac").val(result.paciente.fecha_nac);
      $(".inputCentro").val(result.paciente.centro.nombre + ", " + result.paciente.centro.poblacion);
      $("#fotoPerfil").attr("src", result.paciente.img);

    }).catch(error => console.error('Error status:', error));
  }
}

$('#ConfirmarPedirCita').click(() => {
  pedirCita();
});

$('#inputFile').change(() => {

  var file = event.currentTarget.files[0];

  var reader = new FileReader();

  filename = file.name;
  filesize = file.size;

  if (!new RegExp("(.*?).(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$").test(filename)) {

    $("#inputFile").val("");

  } else {

    reader.onloadend = function () {
      savedFileBase64 = reader.result;
    }
  }
  if (file) {
    reader.readAsDataURL(file);
  }
});

$('#fileButton').click(() => {
  fileUpload();
});

function fileUpload() {

  var tis = $(".inputTis").val();

  var url = "../../controller/controllerImg.php";

  var data = { 'tis': tis, 'savedFileBase64': savedFileBase64 };

  fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
    headers: { 'Content-Type': 'application/json' }

  })
    .then(res => res.json()).then(result => {

      $("#fotoPerfil").attr("src", savedFileBase64);

    }).catch(error => console.error('Error status:', error));

}

function pedirCita() {


  var tis = $('#tis').val();
  var dosis = $('#dosis').val();
  var fechaYhora = $('#fechaPedirCita').val();
  var idCentro = $('#idCentro').val();

  var url = "../../controller/controllerCita.php";

  var data = { 'tis': tis, 'dosis': dosis, 'fechaYhora': fechaYhora, "idCentro": idCentro, "accion": "add" };

  fetch(url, {
    method: 'POST', // or 'POST'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers: { 'Content-Type': 'application/json' }  //input data

  }).then(res => res.json()).then(result => {


  }).catch(error => console.error('Error status:', error));

}

function anularCita (id) {

  var accion = "delete";

  var url = "../../controller/controllerCita.php";

  var data = { 'id':id, "accion":accion};

  fetch(url, {
  method: 'POST', // or 'POST'
  body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{'Content-Type': 'application/json'}  //input data

  })
  .then(res => res.json()).then(result => {

    console.log(result);


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

});

$('#historial').ready(() => {
  historialVacu()
})

async function historialVacu() {
  var sesion = await getSession();
  var data = { 'tis': sesion.tis };
  var url = '../../controller/controllerHistorial.php'

  fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
    headers: { 'Content-Type': 'application/json' }
  }).then(res => res.json()).then(result => {

    i = 0;
    e = 1;
    while (i < result.historial.length) {
      $('#historialVacunacion').append(
        "<button type='button' class='collapsible'>Vacunacion " + e + "</button>" +
        "<div class='cita row mt-3'>" +
        "<div class='col-6 mb-4'>" +
        "<label for='tis' class='form-label'>Tis:</label>" +
        "<input type='text' class='form-control' placeholder='" + result.historial[i].tis + "' disabled>" +
        "<label for='Vacuna' class='form-label'>Vacuna:</label>" +
        "<input type='text' class='form-control' placeholder='" + result.historial[i].objVacuna.marca + "' disabled>" +
        "</div>" +
        "<div class='col-6 mb-4'>" +
        "<label for='Fecha' class='form-label'>Fecha:</label>" +
        "<input type='date' class='form-control' value='" + result.historial[i].fecha + "' disabled>" +
        "<label for='Dosis' class='form-label'>Dosis:</label>" +
        "<input type='text' class='form-control' placeholder='" + result.historial[i].dosis + "' disabled>" +
        "</div>" +
        "</div>"
      );
      collapse();

      i++;
      e++;
    }
    // collapse();
  })
}

// Get SESSION variable
function getSession() {
  return new Promise((resolve, reject) => {
    var url = "../../controller/controllerSession.php";
    fetch(url, {
      method: "GET",
      headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
      resolve(result['SESSION']);
    }).catch(error => console.error('Error status:', error));

  })
}

$('#anularCitaConfir').click(() => {

  var data = { 'idCita': id_cita };
  var url = '../../controller/controllerCitaAnu.php';

  fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
    headers: { 'Content-Type': 'application/json' }
  }).then(res => res.json()).then(result => {


  }).catch(error => console.error('Error status:', error));
})