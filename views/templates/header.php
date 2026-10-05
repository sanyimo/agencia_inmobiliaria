
<header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
    <div class="contenedor contenido-header">
        <div class="barra">
            <a href="/">
                <img src="/build/img/logo.svg" alt="Logotipo de la Agencia de Inmobiliaria">
            </a>
            <div class="mobile-menu">
                <img src="/build/img/barras.svg" alt="icono menu responsive">
            </div>
            
            <div class="derecha">
                <button class="dark-mode-boton" type="button" aria-label="Alternar modo oscuro">
                    <img src="/build/img/dark-mode.svg" alt="">
                </button>
                <div class="selector-idioma" aria-label="Selector de idioma">
                    <a href="<?php echo enlaceIdioma('es'); ?>" class="<?php echo idiomaActual() === 'es' ? 'activo' : ''; ?>">ES</a>
                    <span>|</span>
                    <a href="<?php echo enlaceIdioma('en'); ?>" class="<?php echo idiomaActual() === 'en' ? 'activo' : ''; ?>">EN</a>
                </div>
                <nav class="navegacion">
                    <a href="/nosotros"><?php echo t('Nosotros'); ?></a>
                    <a href="/propiedades"><?php echo t('Anuncios'); ?></a>
                    <a href="/blog"><?php echo t('Blog'); ?></a>
                    <a href="/contacto"><?php echo t('Contacto'); ?></a>
                    <?php if($auth): ?>
                        <a class="admin-link" href="/admin"><?php echo t('Admin'); ?></a>
                        <a href="/logout"><span class="amarillo"><?php echo t('Cerrar sesión'); ?></span></a>
                    <?php endif; ?>
                </nav>
            </div>
        </div><!--.barra-->

        <?php echo $inicio ? '<h1>' . t('Venta de casas y apartamentos exclusivos de lujo') . '</h1>' : ''; ?>
    </div>
</header>
