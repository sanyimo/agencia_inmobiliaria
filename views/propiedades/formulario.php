<fieldset>
    <legend>Información general</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio: </label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file"
    id="imagen" accept="image/webp, image/avif, image/jpeg, image/png" name="propiedad[imagen]">
    <?php if($propiedad->imagen) { ?>
        <img src="/imagenes/imagenesPropiedades/<?php echo $propiedad->imagen ?>" alt="Imagen de la propiedad" class="pic-small">
    <?php } ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>

</fieldset>

<fieldset>
    <legend>Información propiedad</legend>

    <label for="habitaciones">Superficie en m2:</label>
    <input 
        type="number" 
        id="superficie" 
        name="propiedad[superficie]" 
        placeholder="Ej: 80" 
        min="10" 
        max="10000" 
        value="<?php echo s($propiedad->superficie); ?>">

    <label for="habitaciones">Habitaciones:</label>
    <input 
        type="number" 
        id="habitaciones" 
        name="propiedad[habitaciones]" 
        placeholder="Ej: 3" 
        min="1" 
        max="10" 
        value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input 
        type="number" 
        id="wc" 
        name="propiedad[wc]" 
        placeholder="Ej: 3" 
        min="0" max="10" 
        value="<?php echo s($propiedad->wc); ?>">

    <label for="aparcamiento">Aparcamiento:</label>
    <input 
        type="number" 
        id="aparcamiento" 
        name="propiedad[aparcamiento]" 
        placeholder="de 0 a 10" 
        min="0" max="10" 
        value="<?php echo s($propiedad->aparcamiento); ?>">
</fieldset>

<fieldset>
    <legend></legend>
    <label for="vendedor">Vendedor/a</label>
    <select name="propiedad[vendedorId]" id="vendedor">
        <option disabled
        selected
            value="">-- Seleccionar --</option>
            <?php foreach ($vendedores as $vendedor) { ?>
            <option <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : '' ?> value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> </option>
        <?php } ?>
        
    </select>
</fieldset>