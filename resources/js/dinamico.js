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