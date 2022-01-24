$('#loginPaciente').click(() => {
    var x="paciente"
    login(x);  
});


$('#loginAdmin').click(() => {
    var x="admin"
    login(x);
});


function login(x) {

    var tis = $('#tis').val();
    var surname = $('#surname').val();
    var birth = $('#birth').val();
    var usuario = $('#usuario').val();
    var pass = $('#contra').val();

    var url = "";
        
    if (x == "paciente") {
        if ((tis != null && tis != "") && (surname != null && surname != "") && (birth != null && birth != "")) {
            var data = { 'tis':tis, 'apellido':surname, 'fecha_nac':birth, "accion":x};

            url = "controller/controllerLogin.php";

            fetch(url, {
                method: 'POST', // or 'POST'
                body: JSON.stringify(data), // data can be `string` or {object}!
                headers:{'Content-Type': 'application/json'}  //input data
                
            }).then(res => res.json()).then(result => {
            
                console.log( "El login ha sido correcto?: "+result.logged);
    
                if (result.logged) {
                    window.location.href="resources/pages/paciente.html";
                }
            }).catch(error => console.error('Error status:', error));

        }else{
            console("El formulario de registro del paciente no esta relleno correctamente");
            $('#mensajeError').show(150);
            $('#loginPaciente').removeClass('my-3');
        }
    }else if(x == "admin"){
        if ((usuario != null && usuario != "") && (pass != null && pass != "")) {
            var data = {'user':usuario, 'password':pass};

            url = "controller/controllerAdmin.php";

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

        }else{
            console.log("El formulario de registro de los administradores no esta relleno correctamente");
            $('#mensajeError').show(150);
            $('#loginPaciente').removeClass('my-3');
        }
    }
};

