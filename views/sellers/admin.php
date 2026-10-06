<main class="container section">
    <?php $header = $header ?? 'Vendedores'; ?>
    <p id="today"><?php echo dateTime(); ?></p>
    <h1 class="creme"><?php echo $header; ?></h1>

    <div class="admin-nav">
        <a href="/admin" class="btn btn-yellow"><i class="fa-solid fa-arrow-rotate-left"></i> ADMIN</a>
        <a href="/sellers/create" class="btn btn-roof"><i class="fa-solid fa-arrow-down"></i> Nuevo vendedor</a>
        <a href="/properties/admin" class="btn btn-yellow"> Ir a Propiedades <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>E-mail</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- show los Resultados -->
            <?php $sellers = $sellers ?? []; ?>
            <?php foreach ($sellers as $seller): ?>
                <tr>
                    <td><?php echo $seller->id; ?></td>
                    <td><img src="/images/imagesSellers/<?php echo $seller->image; ?>" class="image-table" alt="Imagen del vendedor"></td>
                    <td><?php echo $seller->name . " " . $seller->lastName; ?></td>
                    <td><?php echo $seller->phone; ?></td>
                    <td><?php echo $seller->email; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/sellers/delete">
                            <input type="hidden" name="id" value="<?php echo $seller->id; ?>">
                            <input type="hidden" name="type" value="seller">
                            <div class="btn-gray-block" onclick="if (!confirm('¿Desea borrar a<?php echo $seller->name . ' ' . $seller->lastName; ?>?')) { return false }">
                                <i class="fa-solid fa-trash-can"></i>
                                <input type="submit" value="Eliminar">
                            </div>
                        </form>

                        <a href="./update?id=<?php echo $seller->id; ?>" class="btn-yellow-block"><i class="fa-solid fa-pen"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>