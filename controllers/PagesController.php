<?php
namespace Controllers;

use MVC\Router;
use Model\Property;
use PHPMailer\PHPMailer\PHPMailer;

class PagesController {
    public static function index( Router $router ) {

        $properties = Property::get(3);

        $start = true;
        $router->render('pages/index', [
            'header' => 'Página principal',
            'start' => $start,
            'properties' => $properties
        ]);
    }
    public static function aboutUs(Router $router)
    {
        $router->render('pages/aboutUs', [
            'header' => 'Más sobre nosotros'
        ]);
    }
    public static function properties( Router $router ) {

        $properties = Property::all();

        $router->render('pages/properties', [
            'header' => 'Casas y apartamentos en venta',
            'properties' => $properties
        ]);
    }
    public static function property(Router $router) {
        $id = validateOrRedirect('/properties');

        // Obtener los datos de la propiedad
        $property = Property::find($id);

        $router->render('pages/property', [
            'property' => $property
        ]);
    }
    public static function blog( Router $router ) {
        $router->render('pages/blog', [
            'header' => 'Nuestro Blog'
        ]);
    }
    public static function entry(Router $router)
    {
        $router->render('pages/entry');
    }
    public static function entry2(Router $router)
    {
        $router->render('pages/entry2');
    }

    public static function contact(Router $router)
    {
        $message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar 
            $responses = $_POST['contact'];
            // crear nueva instancia 
            $mail = new PHPMailer();
            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USER'];
            $mail->Password = $_ENV['MAIL_PASS'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['MAIL_PORT'];

            //configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com', $responses['name']);
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';
            // Habilitar HTML 
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8'; 
        
            //definir el contenido
            $content = '<html>';
            $content .= "<p><strong>Has recibido un mensaje de un nuevo posible cliente!</strong></p>";
            $content .= "<p>Nombre: <strong>" . $responses['name'] . "</strong> </p>";
            $content .= "<p>Mensaje: " . $responses['message'] . "</p>";
            $content .= "<p>Vende o Compra: <strong>" . $responses['type'] . "</strong> </p>";
            $content .= "<p>Presupuesto o Precio: <strong>" . $responses['price'] . "</strong> €</p>";

            if ($responses['contact'] === 'phone') {
                $content .= "<p>Prefiere ser contactado por <strong>teléfono</strong>.</p>";
                $content .= "<p>Su teléfono es: <strong>" .  $responses['phone'] . "</strong> </p>";
                $content .= "<p>Fecha y hora: <strong>" . $responses['fecha'] . " - " . $responses['hora']  . " h</strong></p>";
            } else {
                $content .= "<p>Prefiere ser contactado por <strong>email</strong>.</p>";
                $content .= "<p>Su e-mail es: <strong>" .  $responses['email'] ."</strong> </p>";
            }

            $content .= '</html>';
            $mail->Body = $content;
            $mail->AltBody = 'Esto es texto alternativo';

            // send the message
            if($mail->send()){
                $message = 'Mensaje enviado correctamente';
            } else {
                $message = 'Ha ocurrido un error... inténtelo de nuevo';
            }
        }

        $router->render('pages/contact', [
            'header' => 'Contacto',
            'message' => $message
        ]);
    }
}