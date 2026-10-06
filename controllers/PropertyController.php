<?php

namespace Controllers;

use MVC\Router;
use Model\Seller;
use Model\Property;
use Intervention\Image\ImageManagerStatic as Image;

class PropertyController
{
    public static function admin(Router $router)
    {
        $router->render('admin', [
            'header' => t('Panel de Administración')
        ]);
    }

    public static function index(Router $router)
    {
        $properties = Property::all();

        // Display conditional message
        $result = $_GET['result'] ?? null;

        $router->render('properties/admin', [
            'header' => t('Administrador de propiedades'),
            'properties' => $properties,
            'result' => $result
        ]);
    }

    public static function create(Router $router)
    {
        $alerts = Property::getAlerts();
        $property = new Property;
        $sellers = Seller::all();

        // Execute the code after the user submits the form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Create a new instance */
            $args = $_POST['property'];
            $args['sellerId'] = (int) ($args['sellerId'] ?? 0);
            $property = new Property($args);

            // Generate a unique name
            $nameImage = md5(uniqid(rand(), true)) . ".webp";
            $image = null;

            // Resize the image using Intervention Image
            if ($_FILES['property']['tmp_name']['image']) {
                $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
                $property->setImage($nameImage);
            }

            // Validate
            $alerts = $property->validate();

            // Check that the error array is empty
            if (empty($alerts)) {

                // Create the folder to upload images
                if (!is_dir(FOLDER_IMAGES)) {
                    mkdir(FOLDER_IMAGES);
                }

                // Save the image to the server
                if ($image) {
                    $image->save(FOLDER_IMAGES . $nameImage);
                }

                // Save to the database
                $property->guardar();

                Property::setAlert('success', t('Propiedad creada correctamente'));
                $alerts = Property::getAlerts();

                header('Refresh: 1.5; URL=/properties/admin');
            }
        }

        //$alerts = Property::getAlerts();

        $router->render('properties/create', [
            'header' => t('Crear propiedad'),
            'alerts' => $alerts,
            'property' => $property,
            'sellers' => $sellers
        ]);
    }

    public static function update(Router $router)
    {
        $id = validateOrRedirect('/admin');

        // Get property data
        $property = Property::find($id);

        // Get all sellers
        $sellers = Seller::all();

        // Array containing error messages
        $alerts = Property::getAlerts();

        // Execute the code after the user submits the form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Assign the attributes
            $args = $_POST['property'];
            $args['sellerId'] = (int) ($args['sellerId'] ?? 0);
            $property->sync($args);

            // Validation
            $alerts = $property->validate();

            // File upload

            // Generate a unique name
            $nameImage = md5(uniqid(rand(), true)) . ".webp";
            $image = null;

            if ($_FILES['property']['tmp_name']['image']) {
                $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
                $property->setImage($nameImage);
            }

            // Check that the error array is empty
            if (empty($alerts)) {

                if ($_FILES['property']['tmp_name']['image']) {
                    $image->save(FOLDER_IMAGES . $nameImage);
                }

                $property->guardar();

                Property::setAlert('success', t('Propiedad actualizada correctamente'));
                $alerts = Property::getAlerts();

                header('Refresh: 1.5; URL=/properties/admin');
            }
        }

        //$alerts = Property::getAlerts();

        $router->render('properties/update', [
            'header' => t('Actualizar propiedad'),
            'property' => $property,
            'sellers' => $sellers,
            'alerts' => $alerts
        ]);
    }

    public static function delete(Router $router)
    {
        // Delete entry by ID
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validate ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $type = $_POST['type'];

                // Valid requests
                if (validateContentType($type)) {
                    $property = Property::find($id);
                    $property->delete();

                    header('Location: /properties/admin');
                }
            }
        }
    }
}