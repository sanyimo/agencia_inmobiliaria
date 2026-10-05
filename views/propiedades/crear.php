<main class="contenedor seccion">
    <p id="hoydia"><?php echo fechaHora(); ?></p>
    <h1><?php echo $titulo ?? 'Crear Propiedad'; ?></h1>

    <a href="/propiedades/admin" class="boton boton-verde">Volver</a>

    <?php
    $alertas = $alertas ?? [];
    include_once __DIR__ . '/../templates/alertas.php' ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php' ?>

        <input type="submit" value="Crear propiedad" class="boton boton-verde">
    </form>
</main>