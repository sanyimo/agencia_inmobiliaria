<header class="header <?php echo $start ? 'start' : ''; ?>">
    <div class="container content-header">
        <div class="bar">
            <a href="/">
                <img src="/build/img/logo.svg" alt="<?php echo t('Logotipo de la Agencia de Inmobiliaria'); ?>">
            </a>
            <div class="hamburger-menu">
                <img src="/build/img/barras.svg" alt="<?php echo t('Icono menu responsive'); ?>">
            </div>
            
            <div class="right">
                <button
                    class="dark-mode-btn"
                    type="button"
                    aria-label="<?php echo t('Alternar modo oscuro'); ?>"
                    data-dark="<?php echo t('Activar modo oscuro'); ?>"
                    data-light="<?php echo t('Activar modo claro'); ?>">
                    <img src="/build/img/dark-mode.svg" alt="">
                </button>
                <div class="lang-selector" aria-label="<?php echo t('Selector de idioma'); ?>">
                    <a href="<?php echo langRoute('es'); ?>" class="<?php echo currentLanguage() === 'es' ? 't(activo)' : ''; ?>">ES</a>
                    <span>|</span>
                    <a href="<?php echo langRoute('en'); ?>" class="<?php echo currentLanguage() === 'en' ? 't(activo)' : ''; ?>">EN</a>
                </div>
                <nav class="navegation">
                    <a href="/aboutUs"
                        class="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/aboutUs') ? 'active' : ''; ?>">
                        <?php echo t('Nosotros'); ?>
                    </a>

                    <a href="/properties"
                        class="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/properties') ? 'active' : ''; ?>">
                        <?php echo t('Anuncios'); ?>
                    </a>

                    <a href="/blog"
                        class="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/blog') ? 'active' : ''; ?>">
                        <?php echo t('Blog'); ?>
                    </a>

                    <a href="/contact"
                        class="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/contact') ? 'active' : ''; ?>">
                        <?php echo t('Contacto'); ?>
                    </a>
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
