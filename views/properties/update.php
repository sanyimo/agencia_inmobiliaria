<main class="container section">
    <p id="today"><?php echo dateTime(); ?></p>
    <h1 class="creme"><?php echo $header ?? 'Actualizar propiedad'; ?></h1>

    <a href="/properties/admin" class="btn btn-roof">Volver</a>

    <?php
    $alerts = $alerts ?? [];
    include_once __DIR__ . '/../templates/alerts.php' ?>

    <form class="form" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/form.php' ?>

        <input type="submit" value="Actualizar propiedad" class="btn btn-roof">

    </form>
</main>