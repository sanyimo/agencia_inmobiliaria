<?php
namespace MVC;
class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get(string $url, callable $fn) {
        $this->getRoutes[$url] = $fn;
    }

    public function post(string $url, callable $fn) {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes()
    {
        session_start();

        $auth = $_SESSION['login'] ?? null;

        //arreglo de rutas protegidas
        $protected_routes = ['/admin', '/properties/admin', '/properties/create', '/properties/update', '/properties/delete', 'sellers/admin', '/sellers/create', '/sellers/update', '/sellers/delete'];
        $blocked_demo_routes = ['/properties/create', '/properties/update', '/properties/delete', '/sellers/create', '/sellers/update', '/sellers/delete'];
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/'; //path_info no existe en apache sino request_uri
        //$vurrentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'] ;
        $method = $_SERVER['REQUEST_METHOD'];
        //debug($currentUrl);

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        //proteger las rutas
        if (in_array($currentUrl, $protected_routes) && !$auth) {

           header('Location: /');
           exit;
        }

        if($_SESSION['demo'] ?? false) {
            if ($method === 'POST' && in_array($currentUrl, $blocked_demo_routes)) {
                header('Location: /admin');
                exit;
            }
        }
        
        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            echo t('Página no encontrada o ruta no válida');
        }
    }

    //muestra una vista
    public function render(string $view, array $data = [])
    {
        // Leer lo que le pasamos  a la vista
        foreach ($data as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla no reescribe el original, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}