<?php
namespace MVC;
class Router {
    public array $rutasGet = [];
    public array $rutasPost = [];

    public function get(string $url, callable $fn) {
        $this->rutasGet[$url] = $fn;
    }

    public function post(string $url, callable $fn) {
        $this->rutasPost[$url] = $fn;
    }

    public function comprobarRutas() {
        session_start();

        $auth = $_SESSION['login'] ?? null;
       
        //arreglo de rutas protegidas
        $rutas_protegidas = ['/admin','/propiedades/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', 'vendedores/admin', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];
        $rutas_demo_bloqueadas = ['/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];
        $urlActual = $_SERVER['PATH_INFO'] ?? '/' ;//path_info no existe en apache sino request_uri
        //$urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'] ;
        $metodo = $_SERVER['REQUEST_METHOD'];
        //debuguear($urlActual);
        
        if ($metodo === 'GET') {
            $fn = $this->rutasGet[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPost[$urlActual] ?? null;
        }

        //proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {

           header('Location: /');
           exit;
        }

        if($_SESSION['demo'] ?? false) {
            if($metodo === 'POST' && in_array($urlActual, $rutas_demo_bloqueadas)) {
                header('Location: /admin');
                exit;
            }
        }
        
        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            echo "Página no encontrada o ruta no válida";
        }
    }

    //muestra una vista
    public function render(string $view, array $datos = []) {
        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla no reescribe el original, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}