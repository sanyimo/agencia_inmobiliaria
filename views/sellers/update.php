<main class="container section">
    <p id="today"><?php echo dateTime(); ?></p>
    <?php $header = $header ?? 'Actualizar vendedor/a'; ?>
    <h1 class="creme"><?php echo $header; ?></h1>

    <a href="/sellers/admin" class="btn btn-roof">Back</a>

    <?php
    $alerts = $alerts ?? [];
    include_once __DIR__ . '/../templates/alerts.php' ?>

    <form class="form" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/form.php' ?>

        <input type="submit" value="Actualizar vendedor/a" class="btn btn-roof">
    </form>
</main>