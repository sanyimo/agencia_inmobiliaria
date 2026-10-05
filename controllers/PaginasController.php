<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index( Router $router ) {

        $propiedades = Propiedad::get(3);

        $inicio = true;
        $router->render('paginas/index', [
            'titulo' => 'Página principal',
            'inicio' => $inicio,
            'propiedades' => $propiedades
        ]);
    }
    public static function nosotros( Router $router ) {
        $router->render('paginas/nosotros', [
            'titulo' => 'Más sobre nosotros'
        ]);
    }
    public static function propiedades( Router $router ) {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'titulo' => 'Casas y apartamentos en venta',
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router) {
        $id = validarORedireccionar('/propiedades');

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog( Router $router ) {
        $router->render('paginas/blog', [
            'titulo' => 'Nuestro Blog'
        ]);
    }
    public static function entrada( Router $router ) {
        $router->render('paginas/entrada');
    }
    public static function entrada2(Router $router)
    {
        $router->render('paginas/entrada2');
    }
    
    public static function contacto( Router $router ) {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar 
            $respuestas = $_POST['contacto'];
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
            $mail->setFrom('admin@bienesraices.com', $respuestas['nombre']);
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';
            // Habilitar HTML 
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8'; 
        
            //definir el contenido
            $contenido = '<html>';
            $contenido .= "<p><strong>Has recibido un mensaje de un nuevo posible cliente!</strong></p>";
            $contenido .= "<p>Nombre: <strong>" . $respuestas['nombre'] . "</strong> </p>";
            $contenido .= "<p>Mensaje: " . $respuestas['mensaje'] . "</p>";
            $contenido .= "<p>Vende o Compra: <strong>" . $respuestas['tipo'] . "</strong> </p>";
            $contenido .= "<p>Presupuesto o Precio: <strong>" . $respuestas['precio'] . "</strong> €</p>";

            if($respuestas['contacto'] === 'telefono') {
                $contenido .= "<p>Prefiere ser contactado por <strong>teléfono</strong>.</p>";
                $contenido .= "<p>Su teléfono es: <strong>" .  $respuestas['telefono'] ."</strong> </p>";
                $contenido .= "<p>Fecha y hora: <strong>" . $respuestas['fecha'] . " - " . $respuestas['hora']  . " h</strong></p>";
            } else {
                $contenido .= "<p>Prefiere ser contactado por <strong>email</strong>.</p>";
                $contenido .= "<p>Su e-mail es: <strong>" .  $respuestas['email'] ."</strong> </p>";
            }

            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo';

            // send the message
            if($mail->send()){
                $mensaje = 'Mensaje enviado correctamente';
            } else {
                $mensaje = 'Ha ocurrido un error... inténtelo de nuevo';
            }
        }

        $router->render('paginas/contacto', [
            'titulo' => 'Contacto',
            'mensaje' => $mensaje
        ]);
    }
}