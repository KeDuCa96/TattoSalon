<h1 class="nomre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Digita tu nuevo PASSWORD</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>
<div class="acciones">
    <a href="/olvide-password">Volver</a>
</div>
<?php if($error) return; ?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Escribe tu password">
    </div>
    <input type="submit" value="Guardar nuevo password" class="boton">
</form>

<div class="acciones">
    <a href="/">Inicia sesión</a>
    <a href="/crear-cuenta">Crear una cuenta</a>
</div>