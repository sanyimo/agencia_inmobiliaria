<main class="container section">
    <p id="today"><?php echo dateTime(); ?></p>
    <?php $header = $header ?? 'Crear Propiedad'; ?>
    <h1><?php echo t($header); ?></h1>

    <a href="/properties/admin" class="btn btn-roof"><?php echo t('Volver'); ?></a>

    <?php
    $alerts = $alerts ?? [];
    include_once __DIR__ . '/../templates/alerts.php' ?>

    <form class="form" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/form.php' ?>

        <input type="submit" value="<?php echo t('Crear Propiedad'); ?>" class="btn btn-roof">
    </form>
</main>