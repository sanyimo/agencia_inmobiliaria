<main class="container section">
    <?php $header = $header ?? 'Vendedores'; ?>
    <p id="today"><?php echo dateTime(); ?></p>
    <h1 class="creme"><?php echo t($header); ?></h1>

    <div class="admin-nav">
        <a href="/admin" class="btn btn-yellow"><i class="fa-solid fa-arrow-rotate-left"></i> ADMIN</a>
        <a href="/sellers/create" class="btn btn-roof"><i class="fa-solid fa-arrow-down"></i> <?php echo t('Nuevo vendedor'); ?></a>
        <a href="/properties/admin" class="btn btn-yellow"><?php echo t('Ir a Propiedades'); ?> <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th><?php echo t('Imagen'); ?></th>
                <th><?php echo t('Nombre'); ?></th>
                <th><?php echo t('Teléfono'); ?></th>
                <th>E-mail</th>
                <th><?php echo t('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody> <!-- show los Resultados -->
            <?php $sellers = $sellers ?? []; ?>
            <?php foreach ($sellers as $seller): ?>
                <tr>
                    <td><?php echo $seller->id; ?></td>
                    <td><img src="/images/imagesSellers/<?php echo $seller->image; ?>" class="image-table" alt="<?php echo t('Imagen del vendedor'); ?>"></td>
                    <td><?php echo $seller->name . " " . $seller->lastName; ?></td>
                    <td><?php echo $seller->phone; ?></td>
                    <td><?php echo $seller->email; ?></td>
                    <?php
                    $id = $seller->id;
                    $name = $seller->name . ' ' . $seller->lastName;
                    $type = 'seller';
                    $deleteUrl = '/sellers/delete';
                    $updateUrl = '/sellers/update?id=' . $seller->id;

                    require __DIR__ . '/../templates/crud_actions.php';
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>