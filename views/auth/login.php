<main class="container section content-centered">
    <?php $header = $header ?? 'Iniciar sesión'; ?>
    <h1 class="creme"><?php echo t($header); ?></h1>

    <?php
    $alerts = $alerts ?? [];
    include_once __DIR__ . '/../templates/alerts.php' ?>

    <form method="POST" class="form" action="/login">
        <fieldset>
            <legend><?php echo t('Correo electrónico y contraseña'); ?></legend>

            <label for="email"><?php echo t('E-mail'); ?></label>
            <input type="email" name="email" placeholder="<?php echo t('Tu e-mail'); ?>" id="email">

            <label for="password"><?php echo t('Contraseña'); ?></label>
            <input type="password" name="password" placeholder="<?php echo t('Tu contraseña'); ?>" id="password">
        </fieldset>

        <input type="submit" value="<?php echo t('Iniciar sesión'); ?>" class="btn btn-roof">
    </form>
</main>