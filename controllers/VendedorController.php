<?php
namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedorController {
    public static function index(Router $router) {
        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('vendedores/index', [
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {
        $vendedor = new Vendedor;

        // Consultar para obtener los vendedores
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vendedor = new Vendedor($_POST['vendedor']);

            // Generar un nombre único
            $vendedorImagen = md5(uniqid(rand(), true)) . ".jpg";

            //setear la imagen
            // Realiza un resize de imagen con Intervention Image
            if($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                $vendedor->setImagen($vendedorImagen);
            }
            //Validar
            $errores = $vendedor->validar();
            //Revisar que el array de errores esta vacio
            if (empty($errores)) {
                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_VENDEDORES)) {
                    mkdir(CARPETA_VENDEDORES);
                }
                // Guarda la imagen en el servidor
                $image->save(CARPETA_VENDEDORES . $vendedorImagen);

                // Guarda en la base de datos
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        // Obtener los datos del vendedor
        $vendedor = Vendedor::find($id);
        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['vendedor'];
            $vendedor->sincronizar($args);
            // Validación
            $errores = $vendedor->validar();

            // Subida de archivos
            // Generar un nombre único
            $vendedorImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            if($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                $vendedor->setImagen($vendedorImagen);
            }
            //Revisar que el array de errores esta vacio
            if (empty($errores)) {
                if($_FILES['vendedor']['tmp_name']['imagen']) {
                    $image->save(CARPETA_VENDEDORES . $vendedorImagen);
                }
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function eliminar(Router $router) {
        // eliminar entrada segun su id
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $tipo = $_POST['tipo'];
                // peticiones validas
                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}