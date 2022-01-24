window.addEventListener('DOMContentLoaded', () =>{
    loadHeaderFooter()

    if(!window.location.href.includes("index.html")){
        loadPaciente();
    }
})

async function loadHeaderFooter(){
    await new Promise (()=>{
        var ruta = $(location).attr('href').split('/').pop().split('.')[0];

        switch (ruta) {
            case '':
                $('#dynamicFooter').load('resources/pages/footer.html');
                $('#dynamicHeader').load('resources/pages/header.html');
            break;

            case 'index':
                $('#dynamicFooter').load('resources/pages/footer.html');
                $('#dynamicHeader').load('resources/pages/header.html');
            break;
        
            case 'paciente':
                $('#dynamicFooter').load('footer.html');
                $('#dynamicHeader').load('header.html');
            break 
        }
    })
}

function loadPaciente() {
    console.log("entrando en la funcion...")
    var accion="load";
  
    var url = "../../controller/controllerPaciente.php";
    var data = {"accion":accion};
  
    fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
    headers:{'Content-Type': 'application/json'}
    
    })
    .then(res => res.json()).then(result => {
      console.log(result)
      if(typeof result.tis === 'undefined'){
        console.log("un");
      }
      else{
        $('.paciente').hide();
      }
      console.log($('#navbarDarkDropdownMenuLink').text());
      $('#navbarDarkDropdownMenuLink').text(result.nombre);
    })
    .catch(error => console.error('Error status:', error));
}

function pacientePrincipal() {
    var accion="getData";
  
    var url = "../../controller/controllerPaciente.php";
    var data = {"accion":accion};
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers:{'Content-Type': 'application/json'}
        
        })
        .then(res => res.json()).then(result => {
            $('#inputTis').text(result.tis);
            $('#inputNombre').text(result.nombre);
            $('#inputApellidos').text(result.apellidos);
            $('#inputProvincia').text(result.provincia);
            $('#inputNac').text(result.fecha_nac);
            $('#inputCentro').text(result.centro);
        })
}