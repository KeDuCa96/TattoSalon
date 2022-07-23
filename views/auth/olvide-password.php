<h1 class="nombre-pagina">Olvide password</h1>
<p class="descripcion-pagina">Escribe tu Email para restablecer password</p>

<form method="POST" class="formulario" action="/olvide">
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