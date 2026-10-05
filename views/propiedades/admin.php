<main class="contenedor seccion">
    <p id="hoydia"><?php echo fechaHora(); ?></p>
    <h1 class="amarillo"><?php echo $titulo ?? 'Administración de propiedades'; ?></h1>
    
    <div class="admin-nav">
        <a href="/admin" class=" boton-amarillo"><i class="fa-solid fa-arrow-rotate-left"></i> ADMIN</a>
        <a href="/propiedades/crear" class=" boton-verde"><i class="fa-solid fa-arrow-down"></i> Nueva propiedad</a>
        <a href="/vendedores/admin" class=" boton-amarillo"> Ir a Vendedores <i class="fa-solid fa-arrow-right"></i> </a>
    </div>
    

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Superficie</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los Resultados -->
            <?php if (isset($propiedades) && is_array($propiedades)): ?>
                <?php foreach ($propiedades as $propiedad): ?>
                    <tr>
                        <td><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="/imagenes/imagenesPropiedades/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="Imagen de la propiedad"></td>
                        <td><?php echo $propiedad->superficie; ?> m2</td>
                        <td><?php echo $propiedad->precio; ?> €</td>
                        <td>
                            <form method="POST" class="w-100" action="/propiedades/eliminar">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <div class="boton-gris-block"
                                onclick="if (!confirm('¿Desea borrar <?php echo $propiedad->titulo; ?> ?')) { return false }">
                                    <i class="fa-solid fa-trash-can"></i>
                                    <input type="submit" value="Eliminar">
                                </div>
                            </form>
                            
                            <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block"><i class="fa-solid fa-pen"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay propiedades para mostrar.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
