<main class="container section">
    <p id="today"><?php echo dateTime(); ?></p>
    <?php $header = $header ?? 'Administración de propiedades'; ?>
    <h1 class="creme"><?php echo t($header); ?></h1>

    <div class="admin-nav">
        <a href="/admin" class=" btn-yellow"><i class="fa-solid fa-arrow-left"></i> ADMIN</a>
        <a href="/properties/create" class=" btn-roof"><i class="fa-solid fa-arrow-down"></i> <?php echo t('Nueva propiedad'); ?></a>
        <a href="/sellers/admin" class=" btn-yellow"> <?php echo t('Ir a Vendedores'); ?> <i class="fa-solid fa-arrow-right"></i> </a>
    </div>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th><?php echo t('Título'); ?></th>
                <th><?php echo t('Imagen'); ?></th>
                <th><?php echo t('Superficie'); ?></th>
                <th><?php echo t('Precio'); ?></th>
                <th><?php echo t('Acciones'); ?></th>
            </tr>
        </thead>
        <tbody> <!-- show Results -->
            <?php if (isset($properties) && is_array($properties)): ?>
                <?php foreach ($properties as $property): ?>
                    <tr>
                        <td><?php echo $property->id; ?></td>
                        <td><?php echo $property->header; ?></td>
                        <td><img src="/images/imagesProperties/<?php echo $property->image; ?>" class="image-table" alt="<?php echo t('Imagen de la propiedad'); ?>"></td>
                        <td><?php echo $property->area; ?> m2</td>
                        <td><?php echo $property->price; ?> €</td>

                        <?php
                        $id = $property->id;
                        $name = $property->header;
                        $type = 'property';
                        $deleteUrl = '/properties/delete';
                        $updateUrl = '/properties/update?id=' . $property->id;

                        require __DIR__ . '/../templates/crud_actions.php';
                        ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6"><?php echo t('No hay propiedades para mostrar.'); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>