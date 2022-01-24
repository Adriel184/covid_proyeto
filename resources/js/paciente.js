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
<<<<<<< HEAD

<<<<<<< HEAD
window.onload=getView();

function getView() {

  console.log("Entrando en la funcion getView");

=======
function getView() {

  console.log("Entrando en la funcion getView");

>>>>>>> main
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
=======

function getView() {

  console.log("Entrando en la funcion getView");

  var url = "../../controller/controllerView.php";
>>>>>>> main

  if (x=="paciente") {
    var url = "../../controller/controllerPaciente.php";
  }else if(x=="admin") {
    var url = "../../controller/controllerPaciente.php";
  }else{
    var url = "../../controller/controllerPaciente.php";
  }

  fetch(url, {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> main
  method: 'GET', // or 'POST'
  headers:{'Content-Type': 'application/json'}  //input data
  
  })
  .then(res => res.json()).then(result => {
  
<<<<<<< HEAD
    console.log("Los datos del ---> "+x+" se han recibido:");
    console.log(result);

    if (x=="paciente") {
      document.getElementById("navbarDarkDropdownMenuLink").innerHTML=result.paciente.nombre;
      document.getElementById("nombreYApePaciente").value=result.paciente.nombre +" "+result.paciente.apellido;
      document.getElementById("tis").value=result.paciente.tis;
    }else if(x=="admin"){
      console.log("Hola admin");
    }

  })
  .catch(error => console.error('Error status:', error));
  

}


=======
=======
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
>>>>>>> main
  method: 'POST', // or 'POST'
  body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{'Content-Type': 'application/json'}  //input data
  
  })
  .then(res => res.json()).then(result => {
  
    console.log("Los datos del ---> "+x+" se han recibido:");
    console.log(result);

    if (x=="paciente") {
      document.getElementById("navbarDarkDropdownMenuLink").innerHTML=result.paciente.nombre;
      $(".nombreYApePaciente").val(result.paciente.nombre +" "+result.paciente.apellido);
      $(".tis").val(result.paciente.tis);
    }else if(x=="admin"){
      console.log("Hola admin");
    }

  }).catch(error => console.error('Error status:', error));
}

<<<<<<< HEAD
>>>>>>> main
=======
>>>>>>> main
//activar y desactivar la funcion "Disabled"
function enableModify() {
  $("input[name='enable']").prop('disabled', false);
  $("select[name='enable']").prop('disabled', false);
}

function disableModify() {
  $("input[name='enable']").prop('disabled', true);
  $("select[name='enable']").prop('disabled', true);
}