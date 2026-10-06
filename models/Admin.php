<?php 
declare(strict_types=1);

namespace Model;

class Admin extends ActiveRecord
{

    protected static $table = 'users';
    protected static $columnsDB = ['id', 'email', 'password'];

    public ?int $id = null;
    public string $email;
    public string $password;

    public function __construct(array $args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validate()
    {
        if (!$this->email) {
            self::$alerts['error'][] = "El correo electrónico no es válido";
        }

        if (!$this->password) {
            self::$alerts['error'][] = "La contraseña es necesaria";
        }
        return self::$alerts;
    }
    public function userExists(): ?\mysqli_result
    {
        // Escapar el email para evitar inyección SQL
        $email = self::$db->real_escape_string($this->email);

        // Revisar si el usuario existe o no
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $email . "' LIMIT 1";
        $result = self::$db->query($query);

        if (!$result || $result->num_rows === 0) {
            self::$alerts['error'][] = "Este usuario no existe";
            return null; // Retornar null para indicar que no se encontró usuario
        }
        return $result;
    }
    public function checkPassword(?\mysqli_result $result): bool
    {
        if (!$result) {
            return false; // Si no hay resultado, retornar false directamente
        }

        // Obtener el usuario de la consulta
        $user = $result->fetch_object();

        if (!$user) {
            self::$alerts['error'][] = "Usuario no encontrado";
            return false;
        }

        // Verificar si el password es correcto
        if (!password_verify($this->password, $user->password)) {
            self::$alerts['error'][] = 'Contraseña incorrecta';
            return false;
        }

        return true; // La contraseña es correcta
    }

    public function authenticate(): void
    {
        // El usuario esta authenticated
        session_start();

        // Llenar el arreglo de la sesión
        //ROLES????
        $_SESSION['user'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
        exit;
    }
}
