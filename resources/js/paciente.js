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


window.onload=loadPaciente();

function loadPaciente() {
  
  console.log("entrando en la funcion...")
  var accion="load";

  var url = "../../controller/controllerPaciente.php";
  var data = {"accion":accion};

  fetch(url, {
  method: 'POST', // or 'POST'
  body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{'Content-Type': 'application/json'}  //input data
  
  })
  .then(res => res.json()).then(result => {
  
    console.log(result)
    if(typeof result.tis === 'undefined'){
      console.log("un")
    }
    else{
      $('.paciente').show()
    }
    $('#navbarDarkDropdownMenuLink').text(result.nombre)
    

  })
  .catch(error => console.error('Error status:', error));
}

//Permite modificar los centros
function enableModify() {
  $("input[name='enable']").prop('disabled', false);
  $("select[name='enable']").prop('disabled', false);
}

function disableModify() {
  $("input[name='enable']").prop('disabled', true);
  $("select[name='enable']").prop('disabled', true);
}