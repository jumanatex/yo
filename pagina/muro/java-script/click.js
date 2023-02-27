
//AQUI SE EJECUTA EL EVENTO CLICK DE CONFIGURACION.

let divs = document.getElementsByTagName('div');
for (let i = 0; i < divs.length; ++i) {
    if(divs[i].className == 'componentes'){
        divs[i].style.display = 'none';
    }else if (divs[i].className =='encabezado'){
        divs[i].onclick = mostrarOcultarSeccion;
    }
    
}

function mostrarOcultarSeccion(){
    let padre = this.parentNode;
    let componente = padre.getElementsByTagName('div')[1];
    
    if(componente.style.display == 'none'){
        componente.style.display = 'block';
    } else{
        componente.style.display = 'none';
        
    }
    return false;
}


//aqui se cierra la session

const cerrar = document.getElementById('exit');

cerrar.addEventListener("click", function(event){
    const respu =  confirm("¿seguro que quieres salir?");

    if(respu){

    }else{
        event.preventDefault();
    }
});