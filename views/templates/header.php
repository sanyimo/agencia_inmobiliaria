
<header class="header <?php echo $start ? 'start' : ''; ?>">
    <div class="container content-header">
        <div class="bar">
            <a href="/">
                <img src="/build/img/logo.svg" alt="Logotype de la Agencia de Inmobiliaria">
            </a>
            <div class="hamburger-menu">
                <img src="/build/img/barras.svg" alt="icono menu responsive">
            </div>
            
            <div class="right">
                <button class="dark-mode-btn" type="button" aria-label="Alternar modo oscuro">
                    <img src="/build/img/dark-mode.svg" alt="">
                </button>
                <div class="lang-selector" aria-label="Selector de idioma">
                    <a href="<?php echo langRoute('es'); ?>" class="<?php echo currentLanguage() === 'es' ? 'activo' : ''; ?>">ES</a>
                    <span>|</span>
                    <a href="<?php echo langRoute('en'); ?>" class="<?php echo currentLanguage() === 'en' ? 'activo' : ''; ?>">EN</a>
                </div>
                <nav class="navegation">
                    <a href="/aboutUs"><?php echo t('Nosotros'); ?></a>
                    <a href="/properties"><?php echo t('Anuncios'); ?></a>
                    <a href="/blog"><?php echo t('Blog'); ?></a>
                    <a href="/contact"><?php echo t('Contacto'); ?></a>
                    <?php if($auth): ?>
                        <a class="admin-link" href="/admin"><?php echo t('Admin'); ?></a>
                        <a href="/logout"><span class="creme"><?php echo t('Cerrar sesión'); ?></span></a>
                    <?php endif; ?>
                </nav>
            </div>
        </div><!--.bar-->

        <?php echo $start ? '<h1>' . t('Venta de casas y apartamentos exclusivos de lujo') . '</h1>' : ''; ?>
    </div>
</header>
