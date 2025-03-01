<main class="contenedor seccion contenido-centrado">
    <h1 class="amarillo"><?php echo $propiedad->titulo; ?></h1>

    <img loading="lazy" src="/imagenes/imagenesPropiedades/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad">

    <p class="precio"><?php echo $propiedad->precio; ?> €</p>
    <div class=" resumen-propiedad gris">

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono aparcamiento">
                <p><?php echo $propiedad->aparcamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
            <li>
                <p><?php echo $propiedad->superficie; ?>  &#13217;</p>
            </li>
        </ul>

        <p><?php echo $propiedad->descripcion; ?></p>
    </div>
    
    <a href="contacto" class="boton-amarillo">Contáctanos</a>
</main>