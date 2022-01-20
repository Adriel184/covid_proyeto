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
        if (result.error == "incorrect user/password") {
            $('#contraMal').show(150);
            $('#sinContra').hide(150);
        }else if (result.error == "Username or password not filled") {
            $('#sinContra').show(150);
            $('#contraMal').hide(150);
        }else if (result.error == "no error") {
            $('#sinContra').hide(150);
            $('#contraMal').hide(150);
            window.location.href="resources/pages/paciente.html";
        }

    }).catch(error => console.error('Error status:', error));
    
});