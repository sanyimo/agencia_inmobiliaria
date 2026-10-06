<fieldset>
    <legend>Información general</legend>

    <label for="header">Título:</label>
    <input type="text" id="header" name="property[header]" placeholder="Título propiedad" value="<?php echo s($property->header ?? ''); ?>">

    <label for="price">Precio: </label>
    <input type="number" id="price" name="property[price]" placeholder="€" value="<?php echo s($property->price ?? ''); ?>">

    <label for="image">Imagen:</label>
    <input type="file"
        id="image" accept="image/webp, image/avif, image/jpeg, image/png" name="property[image]">
    <img
        id="preview-image"
        src="<?php echo isset($property) && !empty($property->image) ? '/images/imagesProperties/' . $property->image : ''; ?>"
        class="pic-small"
        <?php echo ($property->image ?? null) ? '' : 'hidden'; ?>
        alt="Vista previa de la imagen de la propiedad">

    <label for="description">Descripción:</label>
    <textarea id="description" name="property[description]" placeholder="Escribe aquí..."><?php echo s($property->description ?? ''); ?></textarea>

</fieldset>

<fieldset>
    <legend>Información propiedad</legend>

    <label for="bedrooms">Superficie (&#13217;):</label>
    <input
        type="number"
        id="area"
        name="property[area]"
        placeholder="Ej: 80"
        min="10"
        max="10000"
        value="<?php echo s($property->area ?? ''); ?>">

    <label for="bedrooms">Habitaciones:</label>
    <input
        type="number"
        id="bedrooms"
        name="property[bedrooms]"
        placeholder="Ej: 3"
        min="1"
        max="10"
        value="<?php echo s($property->bedrooms ?? ''); ?>">

    <label for="wc">Baños:</label>
    <input
        type="number"
        id="wc"
        name="property[wc]"
        placeholder="Ej: 3"
        min="0" max="10"
        value="<?php echo s($property->wc ?? ''); ?>">

    <label for="parking">Aparcamiento:</label>
    <input
        type="number"
        id="parking"
        name="property[parking]"
        placeholder="de 0 a 10"
        min="0" max="10"
        value="<?php echo s($property->parking ?? ''); ?>">
</fieldset>

<fieldset>
    <legend></legend>
    <label for="seller">Vendedor/a</label>
    <select name="property[sellerId]" id="seller">
        <option disabled value="" <?php echo empty($property->sellerId) ? 'selected' : '' ?>>-- Seleccionar --</option>
        <?php foreach ($sellers ?? [] as $seller) { ?>
            <option <?php echo (string) ($property->sellerId ?? '') === (string) $seller->id ? 'selected' : '' ?> value="<?php echo s($seller->id); ?>"><?php echo s($seller->name) . " " . s($seller->lastName); ?></option>
        <?php } ?>
    </select>
</fieldset>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('image');
        const preview = document.getElementById('preview-image');

        if (!input || !preview) {
            return;
        }

        input.addEventListener('change', () => {
            const [file] = input.files;

            if (!file) {
                return;
            }

            const url = URL.createObjectURL(file);
            preview.src = url;
            preview.hidden = false;
            preview.onload = () => URL.revokeObjectURL(url);
        });
    });
</script>