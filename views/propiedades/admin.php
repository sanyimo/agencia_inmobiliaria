<main class="contenedor seccion">
    <h1 class="amarillo">Administrador</h1>
    <?php
        $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php }  
    ?>
    
    <?php include __DIR__ . '/../navegacion.php'; ?>

    <h2>Propiedades</h2>
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
            <?php foreach( $propiedades as $propiedad ): ?>
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
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    
                    <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>E-mail</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los Resultados -->
            <?php foreach( $vendedores as $vendedor ): ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><img src="/imagenes/imagenesVendedores/<?php echo $vendedor->imagen; ?>" class="imagen-tabla" alt="Imagen del vendedor"></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td><?php echo $vendedor->email; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/eliminar">

                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    
                    <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>