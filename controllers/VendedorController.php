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

        $router->render('vendedores/admin', [
            'titulo' => 'Administrar vendedores',
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {
        $vendedor = new Vendedor;

        // Consultar para obtener los vendedores
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $alertas = Vendedor::getAlertas();

        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vendedor = new Vendedor($_POST['vendedor']);
            $image = null;

            // Generar un nombre único
            $vendedorImagen = md5(uniqid(rand(), true)) . ".webp";

            //setear la imagen
            // Realiza un resize de imagen con Intervention Image
            if($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                $vendedor->setImagen($vendedorImagen);
            }
            //Validar
            $alertas = $vendedor->validar();
            //Revisar que el array de errores esta vacio
            if (empty($alertas)) {
                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_VENDEDORES)) {
                    mkdir(CARPETA_VENDEDORES);
                }
                // Guarda la imagen en el servidor
                if ($image) {
                    $image->save(CARPETA_VENDEDORES . $vendedorImagen);
                }

                // Guarda en la base de datos
                $vendedor->guardar();
                Vendedor::setAlerta('exito', 'Ficha creada correctamente');
                $alertas = Vendedor::getAlertas();
                header('Refresh: 0.5; URL=/vendedores/admin');
            }
        }
        $router->render('vendedores/crear', [
            'titulo' => 'Registrar nuevo/a vendedor/a',
            'alertas' => $alertas,
            'vendedor' => $vendedor
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        // Obtener los datos del vendedor
        $vendedor = Vendedor::find($id);
        // Arreglo con mensajes de errores
        $alertas = Vendedor::getAlertas();

        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['vendedor'];
            $vendedor->sincronizar($args);
            // Validación
            $alertas = $vendedor->validar();

            // Subida de archivos
            $image = null;
            // Generar un nombre único
            $vendedorImagen = md5( uniqid( rand(), true ) ) . ".webp";

            if($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                $vendedor->setImagen($vendedorImagen);
            }
            //Revisar que el array de errores esta vacio
            if (empty($alertas)) {
                if ($image) {
                    $image->save(CARPETA_VENDEDORES . $vendedorImagen);
                }
                $vendedor->guardar();
                Vendedor::setAlerta('exito', 'Ficha actualizada correctamente');
                $alertas = Vendedor::getAlertas();
                header('Refresh: 0.5; URL=/vendedores/admin');
            }
        }
        
        $router->render('vendedores/actualizar', [
            'titulo' => 'Actualizar ficha de vendedor/a ',
            'vendedor' => $vendedor,
            'alertas' => $alertas
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
                    header('Location: /vendedores/admin');
                }
            }
        }
    }
}