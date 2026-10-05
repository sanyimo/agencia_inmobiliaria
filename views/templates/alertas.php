<?php
if (!empty($alertas)) { // Solo ejecuta el foreach si hay alertas
    foreach ($alertas as $key => $alerta) {
        foreach ($alerta as $mensaje) {
?>
            <div class="alerta alerta__<?php echo $key; ?>"><?php echo $mensaje; ?></div>
<?php
        }
    }
}
?>