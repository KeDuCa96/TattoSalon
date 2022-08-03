<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Por favor elige un servicio y coloca tus datos</p>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button> <!-- Con data-nombreQueQuerramos podemos crear nuestros propios atributos -->
        <button type="button" data-paso="2">Tus datos y tu cita</button> <!-- Con data-nombreQueQuerramos podemos crear nuestros propios atributos -->
        <button type="button" data-paso="3">Resumen</button> <!-- Con data-nombreQueQuerramos podemos crear nuestros propios atributos -->
    </nav>
    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="texto-centrado">Elige tus servicios a continuación</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>
    <div class="seccion" id="paso-2">
        <h2>Tus datos y cita</h2>
        <p class="texto-centrado">Coloca tus datos y fecha de tu cita</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre" value="<?php echo $nombre; ?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" placeholder="Tu fecha">
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora" placeholder="Tu hora">
            </div>
        </form>
    </div>
    <div class="seccion" id="paso-3">
        <h2>Resumen</h2>
        <p class="texto-centrado">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php $script = "<script src='build/js/app.js'></script>"; ?>