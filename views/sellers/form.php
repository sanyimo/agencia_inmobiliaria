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
    <legend><?php echo t('Información general'); ?></legend>
    <label for="image"><?php echo t('Imagen'); ?></label>
    <input type="file" id="image" accept="image/webp, image/avif, image/jpeg, image/png" name="seller[image]">
    <img id="preview-image" src="<?php echo $seller->image ? '/images/imagesSellers/' . $seller->image : ''; ?>"
        class="pic-small" <?php echo $seller->image ? '' : 'hidden'; ?>
        alt="<?php echo t('Vista previa imagen de vendedor/a'); ?>">

    <label for="name"><?php echo t('Nombre'); ?></label>
    <input type="text" id="name" name="seller[name]" placeholder="<?php echo t('Nombre vendedor/a'); ?>"
        value="<?php echo s($seller->name); ?>" autocomplete="name">

    <label for="lastName"><?php echo t('Apellidos'); ?></label>
    <input type="text" id="lastName" 
        name="seller[lastName]" 
        placeholder="<?php echo t('Apellidos vendedor/a'); ?>"
        value="<?php echo s($seller->lastName); ?>">
</fieldset>

<fieldset>
    <legend><?php echo t('Datos de contacto'); ?></legend>

    <label for="phone"><?php echo t('Teléfono'); ?></label>
    <input type="number" id="phone" name="seller[phone]" class="sample" placeholder="&#xf095;"
        value="<?php echo s($seller->phone); ?>" autocomplete="tel">

    <label for="email">E-mail</label>
    <input type="email" id="email" 
        name="seller[email]" 
        class="sample" 
        placeholder="&#xf0e0;"
        value="<?php echo s($seller->email); ?>" autocomplete="email">
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