<?php
if (!empty($alerts)) { // Solo ejecuta el foreach si hay alertas
    foreach ($alerts as $key => $alert) {
        foreach ($alert as $message) {
?>
            <div class="alert alert__<?php echo $key; ?>"><?php echo $message; ?></div>
<?php
        }
    }
}
?>