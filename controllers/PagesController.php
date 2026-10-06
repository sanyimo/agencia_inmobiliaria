<?php

namespace Controllers;

use MVC\Router;
use Model\Property;
use PHPMailer\PHPMailer\PHPMailer;

class PagesController
{
    public static function index(Router $router)
    {
        $properties = Property::get(3);
        $start = true;

        $router->render('pages/index', [
            'header' => t('Página principal'),
            'start' => $start,
            'properties' => $properties
        ]);
    }

    public static function aboutUs(Router $router)
    {
        $router->render('pages/aboutUs', [
            'header' => t('Más sobre nosotros')
        ]);
    }

    public static function properties(Router $router)
    {
        $properties = Property::all();

        $router->render('pages/properties', [
            'header' => t('Casas y apartamentos en venta'),
            'properties' => $properties
        ]);
    }

    public static function property(Router $router)
    {
        $id = validateOrRedirect('/properties');

        // Get property data
        $property = Property::find($id);

        $router->render('pages/property', [
            'property' => $property
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('pages/blog', [
            'header' => t('Nuestro Blog')
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

            // Validate
            $responses = $_POST['contact'];

            // Create new instance
            $mail = new PHPMailer();

            // Configure SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USER'];
            $mail->Password = $_ENV['MAIL_PASS'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['MAIL_PORT'];

            // Configure email content
            $mail->setFrom('admin@bienesraices.com', $responses['name']);
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = t('Tienes un nuevo mensaje');

            // Enable HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Define content
            $content = '<html>';
            $content .= '<p><strong>' . t('Has recibido un mensaje de un nuevo posible cliente!') . '</strong></p>';
            $content .= '<p>' . t('Nombre') . ': <strong>' . $responses['name'] . '</strong></p>';
            $content .= '<p>' . t('Mensaje') . ': ' . $responses['message'] . '</p>';
            $content .= '<p>' . t('Vende o Compra') . ': <strong>' . $responses['type'] . '</strong></p>';
            $content .= '<p>' . t('Presupuesto o Precio') . ': <strong>' . $responses['price'] . '</strong> €</p>';

            if ($responses['contact'] === 'phone') {
                $content .= '<p>' . t('Prefiere ser contactado por teléfono.') . '</p>';
                $content .= '<p>' . t('Su teléfono es') . ': <strong>' . $responses['phone'] . '</strong></p>';
                $content .= '<p>' . t('Fecha y hora') . ': <strong>' . $responses['fecha'] . ' - ' . $responses['hora'] . ' h</strong></p>';
            } else {
                $content .= '<p>' . t('Prefiere ser contactado por email.') . '</p>';
                $content .= '<p>' . t('Su e-mail es') . ': <strong>' . $responses['email'] . '</strong></p>';
            }

            $content .= '</html>';

            $mail->Body = $content;
            $mail->AltBody = t('Esto es texto alternativo');

            // Send the message
            if ($mail->send()) {
                $message = t('Mensaje enviado correctamente');
            } else {
                $message = t('Ha ocurrido un error... inténtelo de nuevo');
            }
        }

        $router->render('pages/contact', [
            'header' => t('Contacto'),
            'message' => $message
        ]);
    }
}
