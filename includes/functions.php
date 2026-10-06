<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . 'functions.php');
define('FOLDER_IMAGES', $_SERVER['DOCUMENT_ROOT'] . '/images/imagesProperties/');
define('FOLDER_SELLERS', $_SERVER['DOCUMENT_ROOT'] . '/images/imagesSellers/');

function isAuthenticated()
{
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function debug(mixed $variable): void
{
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
function validateContentType(string $type): bool
{
    $types = ['seller', 'propiedad'];
    return in_array($type, $types, true);
}

// Muestra los mensajes
/*function mostrarNotificacion($codigo) {
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $message = 'Propiedad creada correctamente';
            break;
        case 2:
            $message = 'Propiedad actualizada correctamente';
            break;
        case 3:
            $message = 'Propiedad eliminada correctamente';
            break;
        case 4:
            $message = 'Vendedor/a registrado/a correctamente';
            break;
        case 5:
            $message = 'Vendedor/a actualizado/a correctamente';
            break;
        case 6:
            $message = 'Vendedor/a eliminado/a correctamente';
            break;
        default:
            $message = false;
            break;
    }
    return $message;
}*/

function validateOrRedirect(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: {$url} " );
    }

    return $id;
}
function dateTime()
{
    setlocale(LC_ALL, 'es_ES');
    date_default_timezone_set('Europe/Madrid');
    $bMonths = array("void", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $bDays = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    $date = getdate();

    $days = $bDays[$date["wday"]];
    $months = $bMonths[$date["mon"]];
    $hour = date('H:i');

    $current = $days . ", " . $date["mday"] . " de " . $months . " de " . $date["year"] . " <br>  " . $hour;

    return $current;
}
function currentLanguage(): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (isset($_GET['lang']) && in_array($_GET['lang'], ['es', 'en'], true)) $_SESSION['language'] = $_GET['lang'];
    return $_SESSION['language'] ?? 'es';
}
function langRoute(string $language): string
{
    $route = $_SERVER['REQUEST_URI'] ?? '/';
    $parts = parse_url($route);
    $parameters = [];

    if (isset($parts['query'])) {
        parse_str($parts['query'], $parameters);
    }

    $parameters['lang'] = $language;

    return ($parts['path'] ?? '/') . '?' . http_build_query($parameters);
}

function t(string $text): string
{
    $translations = [
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
        'Todos los derechos reservados'=>'All rights reserved',
        'Blog'=>'Blog','Admin'=>'Admin','Venta de casas y apartamentos exclusivos de lujo'=>'Luxury homes and apartments for sale',
        'Más sobre nosotros'=>'More about us','Casas y apartamentos en venta'=>'Houses and apartments for sale',
        'Ver todas'=>'View all','Encuentra la casa de tus sueños'=>'Find your dream home',
        'Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la mayor brevedad'=>'Fill out the contact form and an advisor will get in touch with you as soon as possible',
        'Contactános'=>'Contact us','Nuestro Blog'=>'Our Blog','Testimoniales'=>'Testimonials',
        'Ver propiedad'=>'View property','25 Años de experiencia'=>'25 years of experience',
        'Sobre Nosotros'=>'About us','Llene el formulario de contacto'=>'Fill out the contact form',
        'Nombre'=>'Name','Nombre:'=>'Name:','Escriba aquí...'=>'Write here...','-- Seleccione --'=>'-- Select --',
        'Información sobre la propiedad'=>'Property information','Imagen Contacto'=>'Contact image',
        'Texto Entrada Blog'=>'Blog entry text','Texto entrada blog'=>'Blog entry text',
        'imagen de la propiedad'=>'property image'
    ];
    return currentLanguage() === 'en' ? ($translations[$text] ?? $text) : $text;
}
