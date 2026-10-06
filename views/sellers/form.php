<?php
if (!isset($seller)) {
    $seller = new stdClass();
}

$seller->image ??= '';
$seller->name ??= '';
$seller->lastName ??= '';
$seller->phone ??= '';
$seller->email ??= '';
?>

<fieldset>
    <legend>Información general</legend>
    <label for="image">Imagen:</label>
    <input type="file"
        id="image" accept="image/webp, image/avif, image/jpeg, image/png" name="seller[image]">
    <img
        id="preview-image"
        src="<?php echo $seller->image ? '/images/imagesSellers/' . $seller->image : ''; ?>"
        class="pic-small"
        <?php echo $seller->image ? '' : 'hidden'; ?>
        alt="Vista previa de la imagen del vendedor">

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="seller[name]" placeholder="Nombre vendedor" value="<?php echo s($seller->name); ?>">

    <label for="lastName">Apellidos:</label>
    <input type="text" id="lastName" name="seller[lastName]" placeholder="Apellidos seller" value="<?php echo s($seller->lastName); ?>">

</fieldset>

<fieldset>
    <legend>Datos de contacto</legend>

    <label for="phone">Teléfono:</label>
    <input type="number" id="phone" name="seller[phone]" class="sample" placeholder="&#xf095;" value="<?php echo s($seller->phone); ?>">

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="seller[email]" class="sample" placeholder="&#xf0e0;" value="<?php echo s($seller->email); ?>">
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