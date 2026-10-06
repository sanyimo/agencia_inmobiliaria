<main class="container section">
    <h1 class="creme"><?php echo $header ?? 'Contacto'; ?></h1>


    <?php
    $alerts = $alerts ?? [];
    include_once __DIR__ . '/../templates/alerts.php' ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.avif" type="image/avif">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form class="form" action="/contact" method="POST">
        <fieldset>
            <legend>Información personal</legend>

            <label for="name">Nombre</label>
            <input type="text" placeholder="Nombre" id="name" name="contact[name]" required>

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="message">Mensaje:</label>
            <textarea id="message" name="contact[message]" placeholder="Escriba aquí..." required></textarea>

            <label for="options">Vende o compra:</label>
            <select id="options" name="contact[type]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="COMPRA">Compra</option>
                <option value="VENDE">Vende</option>
            </select>

            <label for="budget">Precio o presupuesto</label>
            <input type="number" placeholder="€" id="budget" name="contact[price]" required>

        </fieldset>

        <fieldset>
            <legend>Datos de contacto</legend>

            <p>Cómo desea ser contactado/a</p>

            <div class="contact-method">
                <label for="contact-phone">Teléfono</label>
                <input type="radio" value="phone" id="contact-phone" name="contact[contact]" required>

                <label for="contact-email">E-mail</label>
                <input type="radio" value="email" id="contact-email" name="contact[contact]" required>
            </div>
            <div id="contact"></div>
        </fieldset>

        <input type="submit" value="Enviar" class="btn-roof">
    </form>
</main>