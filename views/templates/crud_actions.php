<td>
    <form method="POST" class="w-100" action="<?php echo $deleteUrl; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="type" value="<?php echo $type; ?>">

        <div class="btn-gray-block"
            onclick="if (!confirm('<?php echo t('¿Deseas borrar'); ?> <?php echo $name; ?>?')) { return false }">
            <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
            <input type="submit"
                value="<?php echo t('Eliminar'); ?>"
                aria-label="<?php echo t('Eliminar'); ?> <?php echo $name; ?>"
                title="<?php echo t('Eliminar'); ?> <?php echo $name; ?>">
        </div>
    </form>

    <a href="<?php echo $updateUrl; ?>"
        class="btn-yellow-block"
        aria-label="<?php echo t('Actualizar'); ?> <?php echo $name; ?>"
        title="<?php echo t('Actualizar'); ?> <?php echo $name; ?>">
        <i class="fa-solid fa-pen" aria-hidden="true"></i>
    </a>
</td>