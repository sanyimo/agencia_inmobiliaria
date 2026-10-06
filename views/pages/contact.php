<main class="container section">
    <?php $header = $header ?? 'Contacto'; ?>
    <h1 class="creme"><?php echo t($header); ?></h1>

    <?php
    $alerts = $alerts ?? [];
    include_once __DIR__ . '/../templates/alerts.php' ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.avif" type="image/avif">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="<?php echo t('Imagen Contacto'); ?>" width="1200" height="575">
    </picture>

    <h2><?php echo t('Rellena el formulario de contacto'); ?></h2>

    <form class="form" action="/contact" method="POST">
        <fieldset>
            <legend><?php echo t('Información personal'); ?></legend>

            <label for="name"><?php echo t('Nombre'); ?></label>
            <input type="text" placeholder="<?php echo t('Nombre'); ?>" id="name" name="contact[name]" autocomplete="off" required>
        </fieldset>

        <fieldset>
            <legend><?php echo t('Información sobre la propiedad'); ?></legend>

            <label for="message"><?php echo t('Mensaje'); ?></label>
            <textarea id="message" name="contact[message]" placeholder="<?php echo t('Escribe aquí...'); ?>" required></textarea>

            <label for="options"><?php echo t('Venta o compra'); ?></label>
            <select id="options" name="contact[type]" required>
                <option value="" disabled selected><?php echo t('-- Selecciona --'); ?></option>
                <option value="COMPRA"><?php echo t('Compra'); ?></option>
                <option value="VENDE"><?php echo t('Venta'); ?></option>
            </select>

            <label for="budget"><?php echo t('Precio o presupuesto'); ?></label>
            <input type="number" placeholder="€" id="budget" name="contact[price]" required>
        </fieldset>

        <fieldset>
            <legend><?php echo t('Datos de contacto'); ?></legend>

            <p><?php echo t('Cómo deseas ser contactado/a'); ?></p>

            <div class="contact-method">
                <label for="contact-phone"><?php echo t('Teléfono'); ?></label>
                <input type="radio" value="phone" id="contact-phone" name="contact[contact]" required>

                <label for="contact-email">E-mail</label>
                <input type="radio" value="email" id="contact-email" name="contact[contact]" required>
            </div>
            <div id="contact"></div>
        </fieldset>

        <input type="submit" value=<?php echo t('Enviar'); ?> class="btn-roof">
    </form>
</main>

<script>
    const translations = {
        callDateTime: <?php echo json_encode(t('Elige la fecha y la hora que mejor le convenga para que te llamemos')); ?>,
        date: <?php echo json_encode(t('Fecha')); ?>,
        hour: <?php echo json_encode(t('Hora')); ?>
    };
</script>