<?php

namespace Controllers;

use MVC\Router;
use Model\Seller;
use Intervention\Image\ImageManagerStatic as Image;

class SellerController
{
    public static function index(Router $router)
    {
        $sellers = Seller::all();

        // Display conditional message
        $result = $_GET['result'] ?? null;

        $router->render('sellers/admin', [
            'header' => t('Administración de vendedores'),
            'sellers' => $sellers,
            'result' => $result
        ]);
    }

    public static function create(Router $router)
    {
        $seller = new Seller;

        // Array containing error messages
        $alerts = Seller::getAlerts();

        // Execute the code after the user submits the form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $seller = new Seller($_POST['seller']);
            $image = null;

            // Generate a unique name
            $sellerImage = md5(uniqid(rand(), true)) . ".webp";

            // Resize the image using Intervention Image
            if ($_FILES['seller']['tmp_name']['image']) {
                $image = Image::make($_FILES['seller']['tmp_name']['image'])->fit(800, 600);
                $seller->setImage($sellerImage);
            }

            // Validate
            $alerts = $seller->validate();

            // Check that the error array is empty
            if (empty($alerts)) {

                // Create the folder to upload images
                if (!is_dir(FOLDER_SELLERS)) {
                    mkdir(FOLDER_SELLERS);
                }

                // Save the image to the server
                if ($image) {
                    $image->save(FOLDER_SELLERS . $sellerImage);
                }

                // Save to the database
                $seller->guardar();

                Seller::setAlert('success', t('Ficha creada correctamente'));
                $alerts = Seller::getAlerts();

                header('Refresh: 1.5; URL=/sellers/admin');
            }
        }

        $router->render('sellers/create', [
            'header' => t('Registrar nuevo/a vendedor/a'),
            'alerts' => $alerts,
            'seller' => $seller
        ]);
    }

    public static function update(Router $router)
    {
        $id = validateOrRedirect('/admin');

        // Get seller data
        $seller = Seller::find($id);

        // Array containing error messages
        $alerts = Seller::getAlerts();

        // Execute the code after the user submits the form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Assign the attributes
            $args = $_POST['seller'];
            $seller->sync($args);

            // Validation
            $alerts = $seller->validate();

            // File upload
            $image = null;

            // Generate a unique name
            $sellerImage = md5(uniqid(rand(), true)) . ".webp";

            if ($_FILES['seller']['tmp_name']['image']) {
                $image = Image::make($_FILES['seller']['tmp_name']['image'])->fit(800, 600);
                $seller->setImage($sellerImage);
            }

            // Check that the error array is empty
            if (empty($alerts)) {

                if ($image) {
                    $image->save(FOLDER_SELLERS . $sellerImage);
                }

                $seller->guardar();

                Seller::setAlert('success', t('Ficha actualizada correctamente'));
                $alerts = Seller::getAlerts();

                header('Refresh: 1.5; URL=/sellers/admin');
            }
        }

        $router->render('sellers/update', [
            'header' => t('Actualizar ficha de vendedor/a'),
            'seller' => $seller,
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

                // Validate request type
                if (validateContentType($type)) {
                    $seller = Seller::find($id);
                    $seller->delete();

                    header('Location: /sellers/admin');
                }
            }
        }
    }
}