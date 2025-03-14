<?php
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'config/database.php';

//conectarnos a la BD
$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);