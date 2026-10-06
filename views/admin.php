<main class="container section">
    <p id="today"><?php echo dateTime(); ?></p>

    <?php if ($_SESSION['demo'] ?? false): ?>
        <p><?php echo t('Modo demo: los cambios que realices no se guardarán en la base de datos.'); ?></p>
    <?php endif; ?>

    <h1 class="creme"><?php echo t($header ?? 'Panel de Administración'); ?></h1>
    <div class="admin-opt">
        <a href="/properties/admin" class="btn btn-roof"><?php echo t('Propiedades'); ?></a>
        <a href="/sellers/admin" class="btn btn-yellow"><?php echo t('Vendedores'); ?></a>
    </div>
</main>