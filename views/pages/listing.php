<div class="container-advertisements">
    <?php $properties = $properties ?? []; ?>
    <?php foreach ($properties as $property) { ?>
        <div class="advertisement">

            <img loading="lazy" src="/images/imagesProperties/<?php echo $property->image; ?>" alt="advertisement">

            <div class="content-advertisement">
                <h3><?php echo $property->header; ?></h3>

                <p class="price">
                    <?php echo number_format($property->price, 0, ',', '.') . ' €'; ?>
                </p>

                <ul class="icons-features">
                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $property->wc; ?></p>
                    </li>
                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono aparcamiento">
                        <p><?php echo $property->parking; ?></p>
                    </li>
                    <li>
                        <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                        <p><?php echo $property->bedrooms; ?></p>
                    </li>
                    <li>
                        <p><?php echo $property->area; ?> &#13217;</p>
                    </li>
                </ul>

                <a href="/property?id=<?php echo $property->id; ?>" class="btn-yellow-block">
                    Ver propiedad
                </a>
            </div><!--.content-advertisement-->
        </div><!--advertisement-->
    <?php }; ?>
</div> <!--.container-advertisements-->