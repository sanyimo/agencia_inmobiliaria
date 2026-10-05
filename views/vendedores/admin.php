<main class="contenedor seccion">
    <?php $titulo = $titulo ?? 'Vendedores'; ?>
    <p id="hoydia"><?php echo fechaHora(); ?></p>
    <h1 class="amarillo"><?php echo $titulo; ?></h1>
            
    <div class="admin-nav">
        <a href="/admin" class="boton boton-amarillo"><i class="fa-solid fa-arrow-rotate-left"></i> ADMIN</a>
        <a href="/vendedores/crear" class="boton boton-verde"><i class="fa-solid fa-arrow-down"></i> Nuevo vendedor</a>
        <a href="/propiedades/admin" class="boton boton-amarillo"> Ir a Propiedades <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    

    <table class="propiedades">
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
        <tbody> <!-- Mostrar los Resultados -->
            <?php $vendedores = $vendedores ?? []; ?>
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
                        <div class="boton-gris-block" onclick="if (!confirm('¿Desea borrar a<?php echo $vendedor->nombre . ' ' .$vendedor->apellido; ?>?')) { return false }" >
                            <i class="fa-solid fa-trash-can"></i>
                            <input  type="submit"  value="Eliminar">
                        </div>
                    </form>
                    
                    <a href="./actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block"><i class="fa-solid fa-pen"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

