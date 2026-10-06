<main class="container section">
    <p id="today"><?php echo dateTime(); ?></p>
    <h1><?php echo $header ?? 'Crear Propiedad'; ?></h1>

    <a href="/properties/admin" class="btn btn-roof">Back</a>

    <?php
    $alerts = $alerts ?? [];
    include_once __DIR__ . '/../templates/alerts.php' ?>

    <form class="form" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/form.php' ?>

        <input type="submit" value="create property" class="btn btn-roof">
    </form>
</main>