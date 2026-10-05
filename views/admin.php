<main class="contenedor seccion">
    <p id="hoydia"><?php echo fechaHora(); ?></p>

    <?php if($_SESSION['demo'] ?? false): ?>
        <p>Modo demo: los cambios que realices no se guardarán en la base de datos.</p>
    <?php endif; ?>
    
    <h1 class="amarillo"><?php echo $titulo ?? 'Administración'; ?></h1>
    <div class="admin-opt">
        <a href="/propiedades/admin" class="boton boton-verde">Propiedades</a>
        <a href="/vendedores/admin" class="boton boton-amarillo">Vendedores</a>
    </div>
</main>
