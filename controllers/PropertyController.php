<?php
namespace Controllers;
use MVC\Router;
use Model\Seller;
use Model\Property;
use Intervention\Image\ImageManagerStatic as Image;


class PropertyController
{
    public static function admin(Router $router) {
        $router->render('admin', [
            'header' => 'Panel de Administración'
        ]);
    }
    public static function index(Router $router) {
        $properties = Property::all();
        // Muestra mensaje condicional
        $result = $_GET['result'] ?? null;

        $router->render('properties/admin', [
            'header' => 'Administrador de propiedades',
            'properties' => $properties,
            'result' => $result
        ]);
    }
    public static function create(Router $router)
    {
        $alerts = Property::getAlerts();
        $property = new Property;
        $sellers = Seller::all();
        
        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /** Crea una nueva instancia */
            $args = $_POST['property'];
            $args['sellerId'] = (int) ($args['sellerId'] ?? 0);
            $property = new Property($args);
            // Generar un name único
            $nameImage = md5(uniqid(rand(), true)) . ".webp";
            $image = null;
            //setear la image
            // Realiza un resize de image con Intervention Image
            if ($_FILES['property']['tmp_name']['image']) {
                $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
                $property->setImage($nameImage);
            }
            //Validar
            $alerts = $property->validate();

            //Revisar que el array de errores esta vacio
            if (empty($alerts)) {
                // Crear la carpeta para subir images
                if (!is_dir(FOLDER_IMAGES)) {
                    mkdir(FOLDER_IMAGES);
                }
                // Guarda la image en el servidor
                if ($image) {
                    $image->save(FOLDER_IMAGES . $nameImage);
                }

                // Guarda en la base de datos
                $property->guardar();
                Property::setAlert('success', 'Propiedad creada correctamente');
                $alerts = Property::getAlerts();
                header('Refresh: 0.5; URL=/properties/admin');
            }
        }
        //$alerts = Property::getAlerts();
        $router->render('properties/create', [
            'header' => 'Crear propiedad',
            'alerts' => $alerts,
            'property' => $property,
            'sellers' => $sellers
        ]);
    }
    public static function update(Router $router)
    {
        $id = validateOrRedirect('/admin');
        // Obtener los datos de la propiedad
        $property = Property::find($id);
        //obtener todos los vendedores
        $sellers = Seller::all();
        // Arreglo con mensajes de errores
        $alerts = Property::getAlerts();
        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['property'];
            $args['sellerId'] = (int) ($args['sellerId'] ?? 0);

            $property->sync($args);
            // Validación
            $alerts = $property->validate();

            // Subida de archivos
            // Generar un name único
            $nameImage = md5(uniqid(rand(), true)) . ".webp";
            $image = null;

            if ($_FILES['property']['tmp_name']['image']) {
                $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
                $property->setImage($nameImage);
            }

            //Revisar que el array de errores esta vacio
            if (empty($alerts)) {
                if ($_FILES['property']['tmp_name']['image']) {
                    $image->save(FOLDER_IMAGES . $nameImage);
                }
                $property->guardar();
                Property::setAlert('success', 'Propiedad actualizada correctamente');
                $alerts = Property::getAlerts();
                header('Refresh: 0.5; URL=/properties/admin');
            }
        }
        //$alerts = Property::getAlerts();
        $router->render('properties/update', [
            'header' => 'Actualizar propiedad',
            'property' => $property,
            'sellers' => $sellers,
            'alerts' => $alerts
        ]);
    }
    public static function delete(Router $router)
    {
        // eliminar entrada segun su id
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id) {
                $type = $_POST['type'];
                // peticiones validas
                if (validateContentType($type)) {
                    $property = Property::find($id);
                    $property->delete();
                    header('Location: /properties/admin');
                }
            }
        }
    }
}