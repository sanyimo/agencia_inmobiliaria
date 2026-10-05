<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/imagenesPropiedades/');
define('CARPETA_VENDEDORES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/imagenesVendedores/');

function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}
function debuguear(mixed $variable): void {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
// Escapa / Sanitizar el HTML
function s(string $html): string {
    $s = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    return $s;
}


// Valida tipo de petición
function validarTipoContenido(string $tipo): bool {
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos, true);
}

// Muestra los mensajes
/*function mostrarNotificacion($codigo) {
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Propiedad creada correctamente';
            break;
        case 2:
            $mensaje = 'Propiedad actualizada correctamente';
            break;
        case 3:
            $mensaje = 'Propiedad eliminada correctamente';
            break;
        case 4:
            $mensaje = 'Vendedor/a registrado/a correctamente';
            break;
        case 5:
            $mensaje = 'Vendedor/a actualizado/a correctamente';
            break;
        case 6:
            $mensaje = 'Vendedor/a eliminado/a correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}*/

function validarORedireccionar(string $url) {
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: {$url} " );
    }

    return $id;
}
function fechaHora() {
    setlocale(LC_ALL, 'es_ES');
    date_default_timezone_set('Europe/Madrid');
    $bMeses = array("void","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    $fecha = getdate();
    
    $dias = $bDias[$fecha["wday"]];
    $meses = $bMeses[$fecha["mon"]];
    $hora = date('H:i');

    $actual = $dias . ", " . $fecha["mday"] ." de ". $meses . " de ". $fecha["year"] . " <br>  " . $hora;

    return $actual;
}