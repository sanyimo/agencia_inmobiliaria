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
                <nav class="navegacion"><span class="idiomas"><a href="?lang=es">ES</a> | <a href="?lang=en">EN</a></span>
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog"><?php echo t('Blog'); ?></a>
                    <a href="/contacto">Contacto</a>
                    <?php if($auth): ?>
                        <a class="admin-link" href="/admin">Admin</a>
                        <a href="/logout"><span class="amarillo">Cerrar sesión</span></a>
                    <?php endif; ?>
                </nav>
            </div>
        </div><!--.barra-->

        <?php  echo $inicio ? "<h1 ><?php echo t('Venta de casas y apartamentos exclusivos de lujo'); ?></h1>" : ''; ?>
    </div>
</header>
    