$('#loginPaciente').click(() => {
    var x="paciente"
    login(x);
});

/*
$('#loginAdmin').click(() => {
    var x="admin"
    login(x);
});
*/


function login(x) {

    var tis = $('#tis').val();
    var surname = $('#surname').val();
    var birth = $('#birth').val();

    console.log(tis);
    console.log(x);
    console.log(surname);
    console.log(birth);

    var url = "controller/controllerLogin.php";
    
    if(x=="paciente"){
        var data = { 'tis':tis, 'apellido':surname, 'fecha_nac':birth, "accion":x};
    }else if (x=="admin") {
        var data = {"accion":x};
    }

    fetch(url, {
    method: 'POST', // or 'POST'
    body: JSON.stringify(data), // data can be `string` or {object}!
    headers:{'Content-Type': 'application/json'}  //input data
    
    })
    .then(res => res.json()).then(result => {
    
        console.log(result.logged);

        if (result.logged) {
            window.location.href="resources/pages/paciente.html";
        }

    })
    .catch(error => console.error('Error status:', error));	
  
    
}
