<main class="contenedor seccion contenido-centrado">
    <?php $titulo = $titulo ?? 'Iniciar sesión'; ?>
    <h1 class="amarillo"><?php echo $titulo; ?></h1>

    <?php
    $alertas = $alertas ?? [];
    include_once __DIR__ . '/../templates/alertas.php' ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Correo electrónico y contraseña</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu e-mail" id="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Tu contraseña" id="password">
        </fieldset>

        <input type="submit" value="Iniciar sesión" class="boton boton-verde">
    </form>
</main>