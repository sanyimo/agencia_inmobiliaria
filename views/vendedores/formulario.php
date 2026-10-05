<?php
if (!isset($vendedor)) {
    $vendedor = new stdClass();
}

$vendedor->imagen ??= '';
$vendedor->nombre ??= '';
$vendedor->apellido ??= '';
$vendedor->telefono ??= '';
$vendedor->email ??= '';
?>

<fieldset>
    <legend>Información general</legend>
    <label for="imagen">Imagen:</label>
    <input type="file"
    id="imagen" accept="image/webp, image/avif, image/jpeg, image/png" name="vendedor[imagen]">
    <?php if ($vendedor->imagen) { ?>
        <img src="/imagenes/imagenesVendedores/<?php echo $vendedor->imagen; ?>" class="pic-small">
    <?php } ?>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellidos:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellidos vendedor" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Datos de contacto</legend>

    <label for="telefono">Teléfono:</label>
    <input type="number" id="telefono" name="vendedor[telefono]" class="muestra" placeholder="&#xf095;" value="<?php echo s($vendedor->telefono); ?>">

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="vendedor[email]" class="muestra" placeholder="&#xf0e0;" value="<?php echo s($vendedor->email); ?>">
</fieldset>