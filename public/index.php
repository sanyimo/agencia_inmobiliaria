<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/app.php';
use MVC\Router;
use Controllers\LoginController;
use Controllers\PagesController;
use Controllers\SellerController;
use Controllers\PropertyController;

$router = new Router();

$router->get('/admin', [PropertyController::class, 'admin']);
$router->get('/properties/admin', [PropertyController::class, 'index']);
$router->get('/properties/create', [PropertyController::class, 'create']);
$router->post('/properties/create', [PropertyController::class, 'create']);
$router->get('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/delete', [PropertyController::class, 'delete']);

$router->get('/sellers/admin', [SellerController::class, 'index']);
$router->get('/sellers/create', [SellerController::class, 'create']);
$router->post('/sellers/create', [SellerController::class, 'create']);
$router->get('/sellers/update', [SellerController::class, 'update']);
$router->post('/sellers/update', [SellerController::class, 'update']);
$router->post('/sellers/delete', [SellerController::class, 'delete']);

$router->get('/', [PagesController::class, 'index']);
$router->get('/aboutUs', [PagesController::class, 'aboutUs']);
$router->get('/properties', [PagesController::class, 'properties']);
$router->get('/property', [PagesController::class, 'property']);
$router->get('/blog', [PagesController::class, 'blog']);
$router->get('/entry', [PagesController::class, 'entry']);
$router->get('/entry2', [PagesController::class, 'entry2']);
$router->get('/contact', [PagesController::class, 'contact']);
$router->post('/contact', [PagesController::class, 'contact']);

// Authentication routes
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Check the routes and execute the corresponding controller method
$router->checkRoutes();