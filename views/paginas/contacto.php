<main class="contenedor seccion">
    <h1 class="amarillo">Contacto</h1>
    
    <?php if($mensaje) { ?>
        <p class="alerta exito">  <?php echo $mensaje ?></p>;
    <?php } ?>
    
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.avif" type="image/avif">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Formulario de contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Nombre" id="nombre" name="contacto[nombre]" required>

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>

            <label for="opciones">Vende o compra:</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="COMPRA">Compra</option>
                <option value="VENDE">Vende</option>
            </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="..." id="presupuesto" name="contacto[precio]" required>

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>Cómo desea ser contactado/a</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>
            <div id="contacto"></div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>