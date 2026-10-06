<?php 

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(Router $router) {
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if($email === 'demo@demo.com' && $password === 'demo1234') {
                $_SESSION['user'] = $email;
                $_SESSION['login'] = true;
                $_SESSION['demo'] = true;
                header('Location: /admin');
                exit;
            }

            $auth = new Admin($_POST);
            $alerts = $auth->validate();

            if (empty($alerts)) {
                // Check if the user exists
                $result = $auth->userExists();
                if (!$result) {
                    $alerts = Admin::getAlerts();
                } else {
                    $authenticated = $auth->checkPassword($result);
                    if ($authenticated) {
                        $auth->authenticate();
                    } else {
                        $alerts = Admin::getAlerts();
                    }
                }
            }
        }
        
        $router->render('auth/login', [
            'header' => t('Iniciar sesión'),
            'alerts' => $alerts
        ]); 
    }
    public static function logout(Router $router) {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}