function collapse(params) {
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

  console.log("Entrando en la funcion getView");

  var url = "../../controller/controllerView.php";

  fetch(url, {
  method: 'GET', // or 'POST'
  headers:{'Content-Type': 'application/json'}  //input data
  
  })
  .then(res => res.json()).then(result => {
  
    console.log("Este es el resultado que devuelve el controllerView: "+ result)
    loadContent(result);

  })
  .catch(error => console.error('Error status:', error));

}

function loadContent(x) {

  console.log("Entrando en la funcion loadcontent para cargar los datos del :"+ x);

  var accion="getData";
  var data = {"accion":accion};

  if (x=="paciente") {
    var url = "../../controller/controllerPaciente.php";
  }else if(x=="admin") {
    var url = "../../controller/controllerPaciente.php";
  }else{
    var url = "../../controller/controllerPaciente.php";
  }

  fetch(url, {
  method: 'POST', // or 'POST'
  body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{'Content-Type': 'application/json'}  //input data
  
  })
  .then(res => res.json()).then(result => {
  
    console.log("Los datos del ---> "+x+" se han recibido:");
    console.log(result);

    if (x=="paciente") {
      document.getElementById("navbarDarkDropdownMenuLink").innerHTML=result.paciente.nombre;
      document.getElementById("nombreYApePaciente").value=result.paciente.nombre +" "+result.paciente.apellido;
      document.getElementById("tis").value=result.paciente.tis;
      document.getElementById("localidad").value=result.paciente.centro.provincia;
      document.getElementById("centro").value=result.paciente.centro.nombre;
      document.getElementById("idCentro").value=result.paciente.centro.id;
      document.getElementById("dosis").value=parseInt(result.paciente.ultimaDosis) + 1;

      
      result.paciente.citas.forEach(element => {
        document.getElementById("divConsultarCitas").innerHTML+="<br><button type='button' class='collapsible'>Cita dosis "+element.dosis+"</button>"
        +"<div class='cita'>"
        +  "<form>"
        +    "<div class='mb-3'>"
        +      "<label for='localidad' class='form-label'>Provincia:</label>"
        +      "<input type='text' class='form-control' placeholder='Localidad' disabled>"
        +    "</div>"
        +    "<div class='mb-3'>" 
        +        "<label for='centro' class='form-label'>Centro:</label>"
        +        "<input type='text' class='form-control' placeholder='Centro' disabled>"
        +    "</div>"
        +    "<div class='mb-3'>"
        +        "<label class='form-label' for='fechaHora'>Fecha y Hora:</label><br>"
        +        "<input type='' class='fechaHora form-control' id='fechaConsultarCita' value='"+element.fecha+" 'disabled>"
        +    "</div> <br>"
        +    "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#anularCita'>Anular Cita</button>"
        +    "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modificarCita' onclick='enableModify()'>Cambiar fecha / hora</button>"
        +    "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#confirmarCitaCita' onclick='disableModify()'>Aceptar</button>"
        +  "</form>"
        +"</div>"
      });

      collapse();

    }else if(x=="admin"){
      console.log("Hola admin");
    }

  })
  .catch(error => console.error('Error status:', error));
  

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
}

function disableModify() {
  $("input[name='enable']").prop('disabled', true);
  $("select[name='enable']").prop('disabled', true);
}