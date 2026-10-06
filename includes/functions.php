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
// Escape / Sanitize HTML output to prevent XSS attacks
function s(string $html): string {
    $s = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    return $s;
}


// Validate content type for sellers and properties
function validateContentType(string $type): bool
{
    $types = ['seller', 'propiedad'];
    return in_array($type, $types, true);
}

// Validate ID and redirect if invalid
function validateOrRedirect(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: {$url} " );
    }

    return $id;
}

// Format date to Spanish or English
function dateTime()
{
    date_default_timezone_set('Europe/Madrid');

    $bMonths = [
        "void",
        t("Enero"),
        t("Febrero"),
        t("Marzo"),
        t("Abril"),
        t("Mayo"),
        t("Junio"),
        t("Julio"),
        t("Agosto"),
        t("Septiembre"),
        t("Octubre"),
        t("Noviembre"),
        t("Diciembre")
    ];

    $bDays = [
        t("Domingo"),
        t("Lunes"),
        t("Martes"),
        t("Miércoles"),
        t("Jueves"),
        t("Viernes"),
        t("Sábado")
    ];

    $date = getdate();
    $days = $bDays[$date["wday"]];
    $months = $bMonths[$date["mon"]];
    $hour = date('H:i');

    if (currentLanguage() === 'en') {
        return $days . ", " . $months . " " . $date["mday"] . ", " . $date["year"] . " <br> " . $hour;
    }

    return $days . ", " . $date["mday"] . " de " . $months . " de " . $date["year"] . " <br> " . $hour;
}

// Get the current language from session or default to Spanish
function currentLanguage(): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (isset($_GET['lang']) && in_array($_GET['lang'], ['es', 'en'], true)) $_SESSION['language'] = $_GET['lang'];
    return $_SESSION['language'] ?? 'es';
}

// Generate a URL with the selected language parameter
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

// Translate text based on the current language
function t(string $text): string
{
    $translations = [
        'Nosotros'=>'About us','Anuncios'=>'Listings', 'Anuncio'=>'Advertisement','Contacto'=>'Contact','Cerrar sesión'=>'Log out',
        'Iniciar sesión'=>'Log in','Correo electrónico y contraseña'=>'Email and password','E-mail'=>'Email',
        'Tu e-mail'=>'Your email','Contraseña'=>'Password','Tu contraseña'=>'Your password',
        'Panel de Administración'=>'Administration panel','Propiedades'=>'Properties','Vendedores'=>'Sellers',
        'Nueva propiedad'=>'New property','Nuevo vendedor'=>'New seller','Ir a Vendedores'=>'Go to Sellers',
        'Ir a Propiedades'=>'Go to Properties','Título'=>'Title','Imagen'=>'Image','Superficie'=>'Area',
        'Precio'=>'Price','Acciones'=>'Actions','Eliminar'=>'Delete','Actualizar'=>'Update',
        'No hay propiedades para mostrar.'=>'There are no properties to display.','Crear propiedad'=>'Create property','Actualizar propiedad'=>'Update property','Crear Propiedad'=>'Create Property','Volver'=>'Back','Información general'=>'General information','Título:'=>'Title:','Título propiedad'=>'Property title','Precio:'=>'Price:','Descripción:'=>'Description:','Escribe aquí...'=>'Write here...','Ej: 80'=>'E.g. 80','Ej: 3'=>'E.g. 3','de 0 a 10'=> 'from 0 to 10',
        'Información propiedad'=>'Property information','Habitaciones:'=>'Bedrooms:','Baños:'=>'Bathrooms:',
        'Aparcamiento:'=>'Parking:','Vendedor/a'=>'Seller','-- Seleccionar --'=>'-- Select --',
        'Crear vendedor'=>'Create seller','Crear ficha'=>'Create profile','Actualizar vendedor/a'=>'Update seller','Actualizar ficha de vendedor/a'=>'Update seller profile','Registrar nuevo/a vendedor/a'=>'Register new seller','Datos de contacto'=>'Contact details','Teléfono'=>'Phone','Teléfono:'=>'Phone:','E-mail:'=>'Email:','Enviar'=>'Send','Información personal'=>'Personal information','Mensaje'=>'Message','Venta o compra'=>'Selling or buying','Compra'=>'Buy','Venta'=>'Sell','Precio o presupuesto'=>'Price or budget','Cómo deseas ser contactado/a'=>'How would you like to be contacted?','No se encontró la propiedad.'=>'Property not found.','Escrito el'=>'Written on','por:'=>'by:','Guía para la decoración de tu hogar'=>'Guide to decorating your home',
        'Terraza en el techo de tu casa'=>'Rooftop terrace for your home','Nos destaca'=>'Why choose us',
        'Modo demo: los cambios que realices no se guardarán en la base de datos.'=>'Demo mode: changes you make will not be saved to the database.','Todos los derechos reservados'=>'All rights reserved',
        'Blog'=>'Blog','Admin'=>'Admin','Venta de casas y apartamentos exclusivos de lujo'=>'Luxury homes and apartments for sale','Más sobre nosotros'=>'More about us','Casas y apartamentos en venta'=>'Houses and apartments for sale','Ver todas'=>'View all','Encuentra la casa de tus sueños'=>'Find your dream home',
        'Rellena el formulario de contacto y un asesor se pondrá en contacto contigo a la mayor brevedad'=>'Fill out the contact form and an advisor will get in touch with you as soon as possible','Contáctanos'=>'Contact us','Nuestro Blog'=>'Our Blog','Testimoniales'=>'Testimonials',
        'Ver propiedad'=>'View property','25 Años de experiencia'=>'25 years of experience','Sobre Nosotros'=>'About us','Rellena el formulario de contacto'=>'Fill out the contact form',
        'Nombre'=>'Name','Nombre:'=>'Name:', 'Apellidos'=>'Last name','Escriba aquí...'=>'Write here...','-- Selecciona --'=>'-- Select --','Información sobre la propiedad'=>'Property information','Imagen Contacto'=>'Contact image','Texto entrada blog'=>'Blog entry text','Imagen de la propiedad' => 'Property image','A tiempo' => 'On time','Seguridad' => 'Security',
        'Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio' => 'Maximize the space in your home with this guide, learn to combine furniture and colors to bring your space to life','Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero' => 'Tips for building a terrace on the roof of your house with the best materials and saving money','El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.'=>'The staff behaved excellently, very good attention and the house they offered me meets all my expectations.','Fecha'=>'Date', 'Hora'=>'Hour','Elige la fecha y la hora que mejor le convenga para que te llamemos'=>'Choose the date and time that best suits you for us to call you','Enero'=>'January','Febrero'=>'February','Marzo'=>'March','Abril'=>'April','Mayo'=>'May','Junio'=>'June','Julio'=>'July','Agosto'=>'August','Septiembre'=>'September','Octubre'=>'October','Noviembre'=>'November','Diciembre'=>'December','Domingo'=>'Sunday','Lunes'=>'Monday','Martes'=>'Tuesday','Miércoles'=>'Wednesday','Jueves'=>'Thursday','Viernes'=>'Friday','Sábado'=>'Saturday',
        'Administrador de propiedades'=>'Property Manager','Administrador de vendedores'=>'Seller Manager','Administración de propiedades'=>'Property Administration','Administración de vendedores'=>'Seller Administration','¿Deseas borrar'=>'Do you want to delete','Vista previa de la imagen de la propiedad'=>'Property image preview','Vista previa imagen de vendedor/a'=>'Seller image preview',
        'Nombre vendedor/a'=>'Seller name','Apellidos vendedor/a'=>'Seller last name','Icono seguridad'=>'Security icon','Icono precio'=>'Price icon','Icono tiempo'=>'Time icon','Icono teléfono'=>'Phone icon','Icono correo electrónico'=>'Email icon','Icono baño'=>'Bathroom icon','Icono habitaciones'=>'Bedrooms icon','Icono aparcamiento'=>'Parking icon', 'Icono menu responsive'=>'Responsive menu icon',
        'No hay vendedores para mostrar.'=>'There are no sellers to display.','No se encontró el vendedor/a.'=>'Seller not found.','No se encontró el vendedor/a'=>'Seller not found.','Imagen del vendedor'=>"Seller's image",'Logotipo de la Agencia de Inmobiliaria'=>'Real Estate Agency Logo',
        'Selector de idioma'=>'Language selector', 'activo'=>'active','Alternar modo oscuro'=>'Toggle dark mode',
        'Activar modo oscuro'=>'Activate dark mode','Activar modo claro'=>'Activate light mode',
        'Página no encontrada o ruta no válida'=>'Page not found or invalid route',
        'El nombre es necesario'=>'The name is required','El apellido es necesario'=>'The last name is required','La imagen es necesaria'=>'Image is required','El teléfono es necesario'=>'The phone number is required',
        'El E-mail es necesario'=>'The email is required',
        'Hace falta un título'=>'A title is required',
        'El precio es necesario'=>'The price is required',
        'La descripción es necesaria y debe tener al menos 150 caracteres'=>'The description is required and must be at least 150 characters long',
        'El número de habitaciones es necesario'=>'The number of bedrooms is required',
        'El número de baños es necesario'=>'The number of bathrooms is required',
        'El número de m2 es necesario'=>'The number of square meters is required',
        'Elige un/a vendedor/a'=>'Choose a seller',
        'El correo electrónico no es válido'=>'The email is not valid',
        'La contraseña es necesaria'=>'The password is required',
        'Este usuario no existe'=>'This user does not exist',
        'Usuario no encontrado'=>'User not found',
        'Contraseña incorrecta'=>'Incorrect password',
        'Ficha creada correctamente'=>'Profile created successfully',
        'Ficha actualizada correctamente'=>'Profile updated successfully',
        'Propiedad creada correctamente'=>'Property created successfully',
        'Propiedad actualizada correctamente'=>'Property updated successfully',
        'Ha ocurrido un error... inténtelo de nuevo'=>'An error has occurred... please try again',
        'Mensaje enviado correctamente'=>'Message sent successfully',
        'Esto es texto alternativo'=>'This is alternative text',
        'Has recibido un mensaje de un nuevo posible cliente!'=>'You have received a message from a new potential client!',
        'Prefiere ser contactado por teléfono.'=>'Prefers to be contacted by phone.',
        'Prefiere ser contactado por email.'=>'Prefers to be contacted by email.',
        'Su teléfono es'=>'Their phone number is',
        'Su e-mail es'=>'Their email is',
        'Fecha y hora'=>'Date and time',
        'Tienes un nuevo mensaje'=>'You have a new message',
        'Vende o Compra'=>'Sell or Buy',
        'Presupuesto o Precio'=>'Budget or Price',
        'Página principal'=>'Main Page'
    ];
    return currentLanguage() === 'en' ? ($translations[$text] ?? $text) : $text;
}