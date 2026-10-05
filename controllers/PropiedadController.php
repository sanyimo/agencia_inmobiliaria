<?php
namespace Controllers;
use MVC\Router;
use Model\Vendedor;
use Model\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController {
    public static function admin(Router $router) {
        $router->render('admin', [
            'titulo' => 'Panel de Administración'
        ]);
    }
    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'titulo' => 'Administrador de propiedades',
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }
    public static function crear(Router $router) {
        $alertas = Propiedad::getAlertas();
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        
        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /** Crea una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".webp";
            $image = null;
            //setear la imagen
            // Realiza un resize de imagen con Intervention Image
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            //Validar
            $alertas = $propiedad->validar();

            //Revisar que el array de errores esta vacio
            if (empty($alertas)) {
                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                // Guarda la imagen en el servidor
                if ($image) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                // Guarda en la base de datos
                $propiedad->guardar();
                Propiedad::setAlerta('exito', 'Propiedad creada correctamente');
                $alertas = Propiedad::getAlertas();
                header('Refresh: 0.5; URL=/propiedades/admin');
            }
        }
        //$alertas = Propiedad::getAlertas();
        $router->render('propiedades/crear', [
            'titulo' => 'Crear propiedad',
            'alertas' => $alertas,
            'propiedad' => $propiedad,
            'vendedores' => $vendedores
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);
        //obtener todos los vendedores
        $vendedores = Vendedor::all();
        // Arreglo con mensajes de errores
        $alertas = Propiedad::getAlertas();
        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);
            // Validación
            $alertas = $propiedad->validar();

            // Subida de archivos
            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".webp";
            $image = null;

            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            
            //Revisar que el array de errores esta vacio
            if (empty($alertas)) {
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
                Propiedad::setAlerta('exito', 'Propiedad actualizada correctamente');
                $alertas = Propiedad::getAlertas();
                header('Refresh: 0.5; URL=/propiedades/admin');
            }
        }
        //$alertas = Propiedad::getAlertas();
        $router->render('propiedades/actualizar', [
            'titulo' => 'Actualizar propiedad',
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                    header('Location: /propiedades/admin');
                }
            }
        }
    }
}