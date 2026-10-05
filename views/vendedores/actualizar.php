<main class="contenedor seccion">
    <p id="hoydia"><?php echo fechaHora(); ?></p>
    <?php $titulo = $titulo ?? 'Actualizar vendedor/a'; ?>
    <h1 class="amarillo"><?php echo $titulo; ?></h1>

    <a href="/vendedores/admin" class="boton boton-verde">Volver</a>

    <?php
    $alertas = $alertas ?? [];
    include_once __DIR__ . '/../templates/alertas.php' ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php' ?>

        <input type="submit" value="Actualizar vendedor/a" class="boton boton-verde">
    </form>
</main>