let paso = 1; //el primero paso o tabs que queramos cargar
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp (){
    mostrarSeccion(); //Muestra y oculta las secciones    
    tabs();  //Cambia la seccion cuando se presionen los tabs
    botonesPaginador(); // Agrega o elimina botones de paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); // Consulta la api en el backend de php
}


function mostrarSeccion(){
        //Ocultar la seccion que tenga la clase de mostrra
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }
        //Seleccions la seccion con el paso...
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add('mostrar');
        //Quitar la clase actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }
        //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function(e){
            paso = parseInt(e.target.dataset.paso); //Con dataset podremos acceder a los atributos que nosotros creamos.

            mostrarSeccion();
            botonesPaginador(); // Volvemos a llamar la funcion para usarla siempre que haya un evento
        });
    });
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    }else if(paso === 2){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        
        if(paso <= pasoInicial) return;

        paso--;

        botonesPaginador();
        mostrarSeccion();
    });
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        
        if(paso >= pasoFinal) return;

        paso++;

        botonesPaginador();
        mostrarSeccion();
    });
}
    /* Fetch API */
async function consultarAPI(){ //

    try { //intenta realizar todas las funciones antes de dar error, previene que la app deje de funcionar por error
        const url = 'http://tattosalon.test/api/cita';
        const resultado = await fetch(url); //await esperar que se descargue todo o se complete la función. fetch nos permite consumir el servicio.
        const servicios = await resultado.json();
        console.log(servicios);
    } catch (error) {
        console.log(Error);
    }
}