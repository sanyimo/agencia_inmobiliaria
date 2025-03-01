<main class="contenedor seccion contenido-centrado">
    <h1 class="amarillo">Iniciar sesión</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Correo electrónico y contraseña</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu e-mail" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Tu contraseña" id="password">
        </fieldset>

        <input type="submit" value="Iniciar sesión" class="boton boton-verde">
    </form>
</main>