<?php
namespace Model;

class ActiveRecord {
    
    public ?int $id = null;
    public ?string $imagen = null;

    // Base DE DATOS
    protected static ?\mysqli $db = null;
    protected static $tabla = '';
    protected static $columnasDB = [];
  
    //errores
    protected static $alertas = [];

    //definir la conexion a la BD
    public static function setDB(\mysqli $database): void {
        self::$db = $database;
    }

    public static function setAlerta(string $tipo, string $mensaje): void {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }
    // Registros - CRUD
    public function guardar() {
        if(!is_null($this->id)) {
            // actualizar
            $this->actualizar();
        } else {
            // Creando un nuevo registro
            $this->crear();
        }
    }
    public function crear() {
        //sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        
        self::$db->query($query);       
    }

    //actualizar
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        self::$db->query($query);

    }

    // Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
        }
    }

    //identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];

        foreach(static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;

    }
    // Subida de archivos
    public function setImagen(?string $imagen): void {
        // Elimina la imagen previa
        if(!is_null($this->id) ) {
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen() {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        $existeVarchivo = file_exists(CARPETA_VENDEDORES. $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        } else if($existeVarchivo) {
            unlink(CARPETA_VENDEDORES . $this->imagen);
        }
    }
    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    //obtiene eterminado numero de registros
    public static function get(int $cantidad): array {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " .$cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

      // Busca un registro por su id
      public static function find(int|string $id): ?static {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }
    // Consulta Plana de SQL (Utilizar cuando los métodos del modelo no son suficientes)
    public static function SQL(string $query): array {
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function consultarSQL(string $query): array {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }
    protected static function crearObjeto(array $registro): static {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
}