<fieldset>
    <legend>Información general</legend>
    <label for="imagen">Imagen:</label>
    <input type="file"
    id="imagen" accept="image/webp, image/avif, image/jpeg, image/png" name="vendedor[imagen]">
    <?php if($vendedor->imagen) { ?>
        <img src="/imagenes/imagenesVendedores/<?php echo $vendedor->imagen ?>" class="pic-small">
    <?php } ?>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor" value="<?php echo s( $vendedor->nombre ); ?>">

    <label for="apellido">Apellidos:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellidos vendedor" value="<?php echo s( $vendedor->apellido ); ?>">

</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">Teléfono:</label>
    <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Teléfono vendedor" value="<?php echo s( $vendedor->telefono ); ?>">

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="vendedor[email]" placeholder="E-mail vendedor" value="<?php echo s( $vendedor->email ); ?>">
</fieldset>