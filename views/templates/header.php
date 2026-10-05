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
                <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="boton modo oscuro ">
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                    <?php if($auth): ?>
                        <a href="/logout"><span class="amarillo">Cerrar sesión</span></a>
                    <?php endif; ?>
                </nav>
            </div>
        </div><!--.barra-->

        <?php  echo $inicio ? "<h1 >Venta de casas y apartamentos exclusivos de lujo</h1>" : ''; ?>
    </div>
</header>
    