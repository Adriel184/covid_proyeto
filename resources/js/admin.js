$('#iniciarAdmin').click(function inicioSesion() { 
    var usuario = $('#usuario').val();
    var pass = $('#contra').val();

    var url = "controller/controllerAdmin.php";
    var data = {'user':usuario, 'password':pass};

    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers:{'Content-Type': 'application/json'}
    }).then(res => res.json()).then(result => {
        console.log(result);
        // console.log(result.ses);
        // if (result.ses) {
        //     console.log(result.user);
        // }
    }).catch(error => console.error('Error status:', error));
    
});