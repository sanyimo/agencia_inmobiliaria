<main class="container section">
    <p id="today"><?php echo dateTime(); ?></p>
    <h1 class="creme"><?php echo $header ?? 'Administración de propiedades'; ?></h1>

    <div class="admin-nav">
        <a href="/admin" class=" btn-yellow"><i class="fa-solid fa-arrow-left"></i> ADMIN</a>
        <a href="/properties/create" class=" btn-roof"><i class="fa-solid fa-arrow-down"></i> Nueva propiedad</a>
        <a href="/sellers/admin" class=" btn-yellow"> Ir a Vendedores <i class="fa-solid fa-arrow-right"></i> </a>
    </div>


    <table class="properties">
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
        <tbody> <!-- show los Resultados -->
            <?php if (isset($properties) && is_array($properties)): ?>
                <?php foreach ($properties as $property): ?>
                    <tr>
                        <td><?php echo $property->id; ?></td>
                        <td><?php echo $property->header; ?></td>
                        <td><img src="/images/imagesProperties/<?php echo $property->image; ?>" class="image-table" alt="Imagen de la propiedad"></td>
                        <td><?php echo $property->area; ?> m2</td>
                        <td><?php echo $property->price; ?> €</td>
                        <td>
                            <form method="POST" class="w-100" action="/properties/delete">
                                <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                                <input type="hidden" name="type" value="property">
                                <div class="btn-gray-block"
                                    onclick="if (!confirm('¿Desea borrar <?php echo $property->header; ?> ?')) { return false }">
                                    <i class="fa-solid fa-trash-can"></i>
                                    <input type="submit" value="Eliminar">
                                </div>
                            </form>

                            <a href="/properties/update?id=<?php echo $property->id; ?>" class="btn-yellow-block"><i class="fa-solid fa-pen"></i></a>
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