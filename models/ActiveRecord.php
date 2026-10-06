<?php
namespace Model;

class ActiveRecord {
    
    public ?int $id = null;
    public ?string $image = null;

    // Base DE DATOS
    protected static ?\mysqli $db = null;
    protected static $table = '';
    protected static $columnsDB = [];

    //errores
    protected static $alerts = [];

    //definir la conexion a la BD
    public static function setDB(\mysqli $database): void {
        self::$db = $database;
    }

    public static function setAlert(string $type, string $message): void
    {
        static::$alerts[$type][] = $message;
    }

    // Validación
    public static function getAlerts()
    {
        return static::$alerts;
    }
    // Registros - CRUD
    public function guardar() {
        if(!is_null($this->id)) {
            // update
            $this->update();
        } else {
            // Creando un nuevo registro
            $this->create();
        }
    }
    public function create()
    {
        //sanitizar los datos
        $attributes = $this->sanitizeAttr();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";
        
        self::$db->query($query);       
    }

    //update
    public function update()
    {
        // Sanitizar los datos
        $attributes = $this->sanitizeAttr();

        $values = [];
        foreach ($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$table . " SET ";
        $query .=  join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        self::$db->query($query);

    }

    // Eliminar un registro
    public function delete()
    {
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);

        if ($result) {
            $this->eraseImage();
        }
    }

    //identificar y unir los atributos de la BD
    public function attributes()
    {
        $attributes = [];

        foreach (static::$columnsDB as $column) {
            if ($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeAttr()
    {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach ($attributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;

    }
    // Subida de archivos
    public function setImage(?string $image): void
    {
        // Elimina la image previa
        if(!is_null($this->id) ) {
            $this->eraseImage();
        }
        // Asignar al atributo de image el name de la image
        if ($image) {
            $this->image = $image;
        }
    }

    public function eraseImage()
    {
        // Comprobar si existe el archivo
        $fileExists = file_exists(FOLDER_IMAGES . $this->image);
        $sellerFileExists = file_exists(FOLDER_SELLERS . $this->image);
        if ($fileExists) {
            unlink(FOLDER_IMAGES . $this->image);
        } else if ($sellerFileExists) {
            unlink(FOLDER_SELLERS . $this->image);
        }
    }
    public function validate()
    {
        static::$alerts = [];
        return static::$alerts;
    }
    public static function all() {
        $query = "SELECT * FROM " . static::$table;

        $result = self::consultSQL($query);

        return $result;
    }
    //obtiene eterminado numero de registros
    public static function get(int $uantity): array
    {
        $query = "SELECT * FROM " . static::$table . " LIMIT " . $uantity;

        $result = self::consultSQL($query);

        return $result;
    }

      // Busca un registro por su id
      public static function find(int|string $id): ?static {
        $query = "SELECT * FROM " . static::$table . " WHERE id = {$id}";

        $result = self::consultSQL($query);

        return array_shift($result);
    }
    // Consulta Plana de SQL (Utilizar cuando los métodos del modelo no son suficientes)
    public static function SQL(string $query): array {
        $result = self::consultSQL($query);
        return $result;
    }
    public static function consultSQL(string $query): array
    {
        // Consultar la base de datos
        $result = self::$db->query($query);

        // Iterar los results
        $array = [];
        while ($register = $result->fetch_assoc()) {
            $array[] = static::createObject($register);
        }
        // liberar la memoria
        $result->free();

        // retornar los resultados
        return $array;
    }
    protected static function createObject(array $register): static
    {
        $object = new static;

        foreach ($register as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }
        return $object;
    }

    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sync($args = [])
    {
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
}