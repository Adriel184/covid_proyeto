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


window.onload=getView();

function getView() {
  
  var accion="load";

  var url = "../../controller/controllerView.php";
  var data = {"accion":accion};

  fetch(url, {
  method: 'POST', // or 'POST'
  body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{'Content-Type': 'application/json'}  //input data
  
  })
  .then(res => res.json()).then(result => {
  
    console.log(result)
    loadContent(result);

  })
  .catch(error => console.error('Error status:', error));

}

function loadContent(x) {

  var accion="getData";
  var data = {"accion":accion};

  if (x=="paciente") {
    var url = "../../controller/controllerPaciente.php";
  }else if (x=="admin") {
    var url = "../../controller/controllerAdmin.php";
  }

  fetch(url, {
  method: 'POST', // or 'POST'
  body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{'Content-Type': 'application/json'}  //input data
  
  })
  .then(res => res.json()).then(result => {
  
    console.log(result)

    if (x=="paciente") {
      if (result.paciente.status=="200") {
        document.getElementById("navbarDarkDropdownMenuLink").innerHTML=result.paciente.nombre;
        document.getElementById("nombreYApePaciente").value=result.paciente.nombre +" "+result.paciente.apellido;
        document.getElementById("tis").value=result.paciente.tis;
      }
    }else if(x=="admin"){
      console.log("Hola admin");
    }

    

  })
  .catch(error => console.error('Error status:', error));
  

}