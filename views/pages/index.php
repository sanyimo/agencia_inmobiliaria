<main class="container section">
    <h1 class="creme">Más sobre nosotros</h1>
    <?php include 'icons.php'; ?>
</main>

<section class="section container">
    <h2 class="creme">Casas y apartamentos en venta</h2>

    <?php include 'listing.php'; ?>

    <div class="align-right">
        <a href="/properties" class="btn-roof">Ver todas</a>
    </div>
</section>

<section class="image-contact">
    <h2 class="creme">Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la mayor brevedad</p>
    <a href="contact" class="btn-yellow">Contactános</a>
</section>

<div class="container section section-inferior">
    <section class="blog gray">
        <h3 class="creme gray">Nuestro Blog</h3>

        <article class="entry-blog gray">
            <div class="image">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.avif" type="image/avif">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="text-entry">
                <a href="entry">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="info-meta">Escrito el: <span>20/10/2025</span> por: <span>Admin</span> </p>

                    <p>
                        Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article>

        <article class="entry-blog gray">
            <div class="image">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.avif" type="image/avif">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="text-entry">
                <a href="entry2">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="info-meta">Escrito el: <span>20/10/2025</span> por: <span>Admin</span> </p>

                    <p>
                        Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio
                    </p>
                </a>
            </div>
        </article>
    </section>

    <section class="testimonials">
        <h3 class="creme">Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Chanelle</p>
        </div>
    </section>
</div>