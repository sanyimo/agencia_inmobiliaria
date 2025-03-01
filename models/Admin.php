<?php
namespace Model;

class Admin extends ActiveRecord {

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!$this->email) {
           self::$errores[] = "El correo electrónico no es válido";
        }

        if(!$this->password) {
            self::$errores[] = "La contraseña es necesaria";
        }
        return self::$errores;
    }
    public function existeUsuario() {
        // Revisar si el usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if( !$resultado->num_rows ) {
            self::$errores[] = "Este usuario no existe";
        }
        return $resultado;
    }
    public function comprobarPassword($resultado){
        // Revisar si el password es correcto
        $usuario = $resultado->fetch_object();

        // Verificar si el password es correcto o no
        $autenticado = password_verify($this->password, $usuario->password);
        if (!$autenticado) {
            self::$errores[] = 'Contraseña incorrecta';
        } 
        return $autenticado;
    }

    public function autenticar() {
        // El usuario esta autenticado
        session_start();

        // Llenar el arreglo de la sesión
        //ROLES????
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}