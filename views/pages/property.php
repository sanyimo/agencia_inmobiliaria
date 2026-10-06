<?php if (isset($property)): ?>
    <main class="container section content-centered">
        <a href="/properties" class="btn btn-roof"><?php echo t('Volver'); ?></a>

        <h1 class="creme"><?php echo $property->header; ?></h1>

        <img loading="lazy" src="/images/imagesProperties/<?php echo $property->image; ?>"
            alt="<?php echo t('Imagen de la propiedad'); ?>">

        <p class="price"><?php echo number_format($property->price, 0, ',', '.') . ' €'; ?></p>
        <div class="summary-propertygray">

            <ul class="icons-features">
                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="<?php echo t('Icono baño'); ?>">
                    <p><?php echo $property->wc; ?></p>
                </li>
                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg"
                        alt="<?php echo t('Icono aparcamiento'); ?>">
                    <p><?php echo $property->parking; ?></p>
                </li>
                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg"
                        alt="<?php echo t('Icono habitaciones'); ?>">
                    <p><?php echo $property->bedrooms; ?></p>
                </li>
                <li>
                    <p><?php echo $property->area; ?> &#13217;</p>
                </li>
            </ul>

            <p><?php echo $property->description; ?></p>
        </div>

        <a href="contact" class="btn-yellow"><?php echo t('Contáctanos'); ?></a>
    </main>
    
<?php else: ?>
    <main class="container section content-centered">
        <p class="alert-error"><?php echo t('No se encontró la propiedad.'); ?></p>
    </main>
<?php endif; ?>