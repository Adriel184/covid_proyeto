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

    var url = "controller/controllerLogin.php";
    if ((tis != null && tis != "") && (surname != null && surname != "") && (birth != null && birth != "")) {
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
        
            console.log( "El login ha sido correcto?: "+result.logged);

            if (result.logged) {
                window.location.href="resources/pages/paciente.html";
            }
        }).catch(error => console.error('Error status:', error));
    }else{
        $('#mensajeError').show(150);
        $('#loginPaciente').removeClass('my-3');
    }
        
};

