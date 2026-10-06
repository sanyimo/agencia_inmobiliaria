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
            self::$alerts['error'][] = t('El correo electrónico no es válido');
        }

        if (!$this->password) {
            self::$alerts['error'][] = t('La contraseña es necesaria');
        }
        return self::$alerts;
    }

    public function userExists(): ?\mysqli_result
    {
        // Sanitize the email to prevent SQL injection
        $email = self::$db->real_escape_string($this->email);

        // Query the database to check if the user exists
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $email . "' LIMIT 1";
        $result = self::$db->query($query);

        if (!$result || $result->num_rows === 0) {
            self::$alerts['error'][] = t('Este usuario no existe');
            return null;
        }
        return $result;
    }
    public function checkPassword(?\mysqli_result $result): bool
    {
        if (!$result) {
            return false; // No result to check against
        }

        // Fetch the user data from the result
        $user = $result->fetch_object();

        if (!$user) {
            self::$alerts['error'][] = t('Usuario no encontrado');
            return false;
        }

        // Check if the provided password matches the hashed password in the database
        if (!password_verify($this->password, $user->password)) {
            self::$alerts['error'][] = t('Contraseña incorrecta');
            return false;
        }

        return true; // Password is correct
    }

    public function authenticate(): void
    {
        // Start the session if it hasn't been started yet
        session_start();

        // Set session variables to indicate the user is logged in
        $_SESSION['user'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
        exit;
    }
}