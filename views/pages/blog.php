<main class="container section content-centered">
    <?php $header = $header ?? 'Blog'; ?>
    <h1 class="creme"><?php echo t($header); ?></h1>

    <article class="entry-blog gray">
        <div class="image">
            <picture>
                <source srcset="build/img/blog1.webp" type="image/webp">
                <source srcset="build/img/blog1.avif" type="image/avif">
                <source srcset="build/img/blog1.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/blog1.jpg" alt="<?php echo t('Texto entrada blog'); ?>">
            </picture>
        </div>

        <div class="text-entry">
            <a href="/entry2">
                <h4><?php echo t('Terraza en el techo de tu casa'); ?></h4>
                <p class="info-meta"><?php echo t('Escrito el'); ?>: <span>28/10/2026</span> <?php echo t('por:'); ?> <span>Admin</span></p>

                <p>
                    <?php echo t('Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero'); ?>
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
                <img loading="lazy" src="build/img/blog2.jpg" alt="<?php echo t('Texto entrada blog'); ?>">
            </picture>
        </div>

        <div class="text-entry">
            <a href="/entry2">
                <h4><?php echo t('Guía para la decoración de tu hogar'); ?></h4>
                <p class="info-meta"><?php echo t('Escrito el'); ?>: <span>28/09/2026</span> <?php echo t('por:'); ?> <span>Admin</span> </p>
                <p>
                    <?php echo t('Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio'); ?>
                </p>
            </a>
        </div>
    </article>

    <article class="entry-blog gray">
        <div class="image">
            <picture>
                <source srcset="build/img/blog3.webp" type="image/webp">
                <source srcset="build/img/blog3.avif" type="image/avif">
                <source srcset="build/img/blog3.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/blog3.jpg" alt="<?php echo t('Texto entrada blog'); ?>">
            </picture>
        </div>

        <div class="text-entry">
            <a href="/entry">
                <h4><?php echo t('Terraza en el techo de tu casa'); ?></h4>
                <p class="info-meta"><?php echo t('Escrito el'); ?>: <span>20/11/2026</span> <?php echo t('por:'); ?> <span>Admin</span> </p>

                <p>
                    <?php echo t('Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero'); ?>
                </p>
            </a>
        </div>
    </article>

    <article class="entry-blog gray">
        <div class="image">
            <picture>
                <source srcset="build/img/blog4.webp" type="image/webp">
                <source srcset="build/img/blog4.avif" type="image/avif">
                <source srcset="build/img/blog4.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/blog4.jpg" alt="<?php echo t('Texto entrada blog'); ?>">
            </picture>
        </div>

        <div class="text-entry">
            <a href="/entry">
                <h4><?php echo t('Guía para la decoración de tu hogar'); ?></h4>
                <p class="info-meta"><?php echo t('Escrito el'); ?>: <span>28/10/2026</span> <?php echo t('por:'); ?> <span>Admin</span> </p>

                <p>
                    <?php echo t('Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio'); ?>
                </p>
            </a>
        </div>
    </article>
</main>