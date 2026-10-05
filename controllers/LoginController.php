<?php 

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(Router $router) {
        $alertas = []; 

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $alertas = $auth->validar();

            if (empty($alertas)) {
                //verificar si existe usuario o no
                $resultado = $auth->existeUsuario();
                if( !$resultado ) {
                    $alertas = Admin::getAlertas();
                } else {
                    $autenticado = $auth->comprobarPassword($resultado);
                    if($autenticado) {
                       $auth->autenticar();
                    } else {
                        $alertas = Admin::getAlertas();
                    }
                }
            }
        }
        
        $router->render('auth/login', [
            'titulo' => 'Iniciar sesión',
            'alertas' => $alertas
        ]); 
    }
    public static function logout(Router $router) {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}