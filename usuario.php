<?php
//entraras en /usuario.php, aqui abajo cambias los datos de mail/pass, recargas y ya consta en la BD
require 'includes/app.php';

// Crear un email y password
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);
 //var_dump($passwordHash);

// Query para crear el usuario
$query = " INSERT INTO usuarios (email, password) VALUES ( '{$email}', '{$passwordHash}'); ";

 // echo $query;

// Agregarlo a la base de datos
mysqli_query($db, $query);
