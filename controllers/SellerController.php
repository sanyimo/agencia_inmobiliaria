<?php
namespace Controllers;

use MVC\Router;
use Model\Seller;
use Intervention\Image\ImageManagerStatic as Image;

class SellerController {
    public static function index(Router $router) {
        $sellers = Seller::all();

        // Muestra mensaje condicional
        $result = $_GET['result'] ?? null;

        $router->render('sellers/admin', [
            'header' => 'Administrar vendedores',
            'sellers' => $sellers,
            'result' => $result
        ]);
    }

    public static function create(Router $router)
    {
        $seller = new Seller;

        // Consultar para obtener los vendedores
        $sellers = Seller::all();

        // Arreglo con mensajes de errores
        $alerts = Seller::getAlerts();

        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $seller = new Seller($_POST['seller']);
            $image = null;

            // Generar un name único
            $sellerImage = md5(uniqid(rand(), true)) . ".webp";

            //setear la image
            // Realiza un resize de image con Intervention Image
            if ($_FILES['seller']['tmp_name']['image']) {
                $image = Image::make($_FILES['seller']['tmp_name']['image'])->fit(800, 600);
                $seller->setImage($sellerImage);
            }
            //Validar
            $alerts = $seller->validate();
            //Revisar que el array de errores esta vacio
            if (empty($alerts)) {
                // Crear la carpeta para subir images
                if (!is_dir(FOLDER_SELLERS)) {
                    mkdir(FOLDER_SELLERS);
                }
                // Guarda la image en el servidor
                if ($image) {
                    $image->save(FOLDER_SELLERS . $sellerImage);
                }

                // Guarda en la base de datos
                $seller->guardar();
                Seller::setAlert('success', 'Ficha creada correctamente');
                $alerts = Seller::getAlerts();
                header('Refresh: 0.5; URL=/sellers/admin');
            }
        }
        $router->render('sellers/create', [
            'header' => 'Registrar nuevo/a vendedor/a',
            'alerts' => $alerts,
            'seller' => $seller
        ]);
    }
    public static function update(Router $router) {
        $id = validateOrRedirect('/admin');
        // Obtener los datos del vendedor
        $seller = Seller::find($id);
        // Arreglo con mensajes de errores
        $alerts = Seller::getAlerts();

        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['seller'];
            $seller->sync($args);
            // Validación
            $alerts = $seller->validate();

            // Subida de archivos
            $image = null;
            // Generar un name único
            $sellerImage = md5(uniqid(rand(), true)) . ".webp";

            if ($_FILES['seller']['tmp_name']['image']) {
                $image = Image::make($_FILES['seller']['tmp_name']['image'])->fit(800, 600);
                $seller->setImage($sellerImage);
            }
            //Revisar que el array de errores esta vacio
            if (empty($alerts)) {
                if ($image) {
                    $image->save(FOLDER_SELLERS . $sellerImage);
                }
                $seller->guardar();
                Seller::setAlert('success', 'Ficha actualizada correctamente');
                $alerts = Seller::getAlerts();
                header('Refresh: 0.5; URL=/sellers/admin');
            }
        }

        $router->render('sellers/update', [
            'header' => 'Actualizar ficha de vendedor/a ',
            'seller' => $seller,
            'alerts' => $alerts
        ]);
    }
    public static function delete(Router $router) {
       
        // eliminar entrada segun su id
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $type = $_POST['type'];
                // peticiones validas
                if (validateContentType($type)) {
                    $seller = Seller::find($id);
                    $seller->delete();
                    header('Location: /sellers/admin');
                }
            }
        }
    }
}