$('#loginPaciente').click(() => {
    console.log("Se ha hecho submit")
    loadPaciente();
});


function loadPaciente() {

    var tis = $('#tis').val();
    var surname = $('#surname').val();
    var birth = $('#birth').val();
      
    var url = "controller/controllerPaciente.php";
    var data = { 'tis':tis, 'apellido':surname, 'fecha_nac':birth};

    fetch(url, {
    method: 'POST', // or 'POST'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers:{'Content-Type': 'application/json'}  //input data
    
    })
    .then(res => res.json()).then(result => {
    
        console.log(result.logged);

    })
    .catch(error => console.error('Error status:', error));	
  
    
  }