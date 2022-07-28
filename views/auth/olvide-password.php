<h1 class="nombre-pagina">Olvide password</h1>
<p class="descripcion-pagina">Escribe tu Email para restablecer password</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>
<form method="POST" class="formulario" action="/olvide-password">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email">
    </div>
    <input type="submit" class="boton" value="Enviar instrucciones">
</form>

<div class="acciones">
    <a href="/">Inicia sesión</a>
    <a href="/crear-cuenta">Crear una cuenta</a>
</div>