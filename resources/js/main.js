$('#loginPaciente').click(function loadPaciente() {


    var accion="login"
    var tis = $('#tis').val();
    var surname = $('#surname').val();
    var birth = $('#birth').val();

    console.log(tis);
    console.log(surname);
    console.log(birth);
      
    var url = "controller/controllerPaciente.php";
    var data = { 'tis':tis, 'apellido':surname, 'fecha_nac':birth, "accion":accion};

    fetch(url, {
    method: 'POST', // or 'POST'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers:{'Content-Type': 'application/json'}  //input data
    
    })
    .then(res => res.json()).then(result => {
    
        console.log(result.logged);
        if (result.logged) {
            window.location.href="resources/pages/paciente.html";
            console.log(result.paciente)
        }
    }).catch(error => console.error('Error status:', error));
});

