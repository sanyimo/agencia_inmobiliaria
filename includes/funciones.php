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
function idiomaActual(): string {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (isset($_GET['lang']) && in_array($_GET['lang'], ['es', 'en'], true)) $_SESSION['idioma'] = $_GET['lang'];
    return $_SESSION['idioma'] ?? 'es';
}
function t(string $texto): string {
    $traducciones = [
        'Nosotros'=>'About us','Anuncios'=>'Listings','Contacto'=>'Contact','Cerrar sesión'=>'Log out',
        'Iniciar sesión'=>'Log in','Correo electrónico y contraseña'=>'Email and password','E-mail'=>'Email',
        'Tu e-mail'=>'Your email','Contraseña'=>'Password','Tu contraseña'=>'Your password',
        'Panel de Administración'=>'Administration panel','Propiedades'=>'Properties','Vendedores'=>'Sellers',
        'Nueva propiedad'=>'New property','Nuevo vendedor'=>'New seller','Ir a Vendedores'=>'Go to Sellers',
        'Ir a Propiedades'=>'Go to Properties','Título'=>'Title','Imagen'=>'Image','Superficie'=>'Area',
        'Precio'=>'Price','Acciones'=>'Actions','Eliminar'=>'Delete','Actualizar'=>'Update',
        'No hay propiedades para mostrar.'=>'There are no properties to display.','Crear propiedad'=>'Create property',
        'Actualizar propiedad'=>'Update property','Crear Propiedad'=>'Create Property','Volver'=>'Back',
        'Información general'=>'General information','Título:'=>'Title:','Título propiedad'=>'Property title',
        'Precio:'=>'Price:','Descripción:'=>'Description:','Escribe aquí...'=>'Write here...',
        'Información propiedad'=>'Property information','Habitaciones:'=>'Bedrooms:','Baños:'=>'Bathrooms:',
        'Aparcamiento:'=>'Parking:','Vendedor/a'=>'Seller','-- Seleccionar --'=>'-- Select --',
        'Crear vendedor'=>'Create seller','Crear ficha'=>'Create profile','Actualizar vendedor/a'=>'Update seller',
        'Registrar nuevo/a vendedor/a'=>'Register new seller','Datos de contacto'=>'Contact details',
        'Teléfono'=>'Phone','Teléfono:'=>'Phone:','E-mail:'=>'Email:','Enviar'=>'Send',
        'Información personal'=>'Personal information','Mensaje:'=>'Message:','Vende o compra:'=>'Selling or buying:',
        'Compra'=>'Buy','Vende'=>'Sell','Precio o presupuesto'=>'Price or budget',
        'Cómo desea ser contactado/a'=>'How would you like to be contacted?','No se encontró la propiedad.'=>'Property not found.',
        'Escrito el:'=>'Written on:','por:'=>'by:','Guía para la decoración de tu hogar'=>'Guide to decorating your home',
        'Terraza en el techo de tu casa'=>'Rooftop terrace for your home','Nos destaca'=>'Why choose us',
        'Modo demo: los cambios que realices no se guardarán en la base de datos.'=>'Demo mode: changes you make will not be saved to the database.',
        'Todos los derechos reservados'=>'All rights reserved'
    ];
    return idiomaActual() === 'en' ? ($traducciones[$texto] ?? $texto) : $texto;
}
