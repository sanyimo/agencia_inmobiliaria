<main class="contenedor seccion contenido-centrado">
    <?php $titulo = $titulo ?? 'Iniciar sesión'; ?>
    <h1 class="amarillo"><?php echo t($titulo); ?></h1>

    <?php
    $alertas = $alertas ?? [];
    include_once __DIR__ . '/../templates/alertas.php' ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend><?php echo t('Correo electrónico y contraseña'); ?></legend>

            <label for="email"><?php echo t('E-mail'); ?></label>
            <input type="email" name="email" placeholder="<?php echo t('Tu e-mail'); ?>" id="email">

            <label for="password"><?php echo t('Contraseña'); ?></label>
            <input type="password" name="password" placeholder="<?php echo t('Tu contraseña'); ?>" id="password">
        </fieldset>

        <input type="submit" value="<?php echo t('Iniciar sesión'); ?>" class="boton boton-verde">
    </form>
</main>