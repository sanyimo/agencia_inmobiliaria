<main class="container section">
    <p id="today"><?php echo dateTime(); ?></p>
    <?php $header = $header ?? 'Actualizar propiedad'; ?>
    <h1 class="creme"><?php echo t($header); ?></h1>

    <a href="/properties/admin" class="btn btn-roof"><?php echo t('Volver'); ?></a>

    <?php
    $alerts = $alerts ?? [];
    include_once __DIR__ . '/../templates/alerts.php' ?>

    <form class="form" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/form.php' ?>

        <input type="submit" value="<?php echo t('Actualizar propiedad'); ?>" class="btn btn-roof">
    </form>
</main>