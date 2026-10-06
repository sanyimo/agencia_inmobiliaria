<?php
namespace Model;

class ActiveRecord {
    
    public ?int $id = null;
    public ?string $image = null;

    // Database connection
    protected static ?\mysqli $db = null;
    protected static $table = '';
    protected static $columnsDB = [];

    //errors
    protected static $alerts = [];

    //define the database connection
    public static function setDB(\mysqli $database): void {
        self::$db = $database;
    }

    // Set an alert message
    public static function setAlert(string $type, string $message): void
    {
        static::$alerts[$type][] = $message;
    }

    // Validation of the model
    public static function getAlerts()
    {
        return static::$alerts;
    }
    // Registries - CRUD
    public function guardar() {
        if(!is_null($this->id)) {
            // update
            $this->update();
        } else {
            // Create a new record
            $this->create();
        }
    }
    public function create()
    {
        //sanitize the data
        $attributes = $this->sanitizeAttr();

        // Insert into the database
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
        // Sanitize the data
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

    // Eliminate a record
    public function delete()
    {
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);

        if ($result) {
            $this->eraseImage();
        }
    }

    //identify the attributes of the object that are in the database
    public function attributes()
    {
        $attributes = [];

        foreach (static::$columnsDB as $column) {
            if ($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    // Sanitize the attributes before saving to the database
    public function sanitizeAttr()
    {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach ($attributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;

    }
    // Set the image for the record
    public function setImage(?string $image): void
    {
        // Eliminate the previous image if it exists
        if(!is_null($this->id) ) {
            $this->eraseImage();
        }
        // Assign the new image
        if ($image) {
            $this->image = $image;
        }
    }

    // Eliminate the image from the server
    public function eraseImage()
    {
        // Check if the image exists
        $fileExists = file_exists(FOLDER_IMAGES . $this->image);
        $sellerFileExists = file_exists(FOLDER_SELLERS . $this->image);
        // Delete the image
        if ($fileExists) {
            unlink(FOLDER_IMAGES . $this->image);
        } else if ($sellerFileExists) {
            unlink(FOLDER_SELLERS . $this->image);
        }
    }

    // Validation
    public function validate()
    {
        static::$alerts = [];
        return static::$alerts;
    }

    // Querys
    public static function all() {
        $query = "SELECT * FROM " . static::$table;

        $result = self::consultSQL($query);

        return $result;
    }

    // Get a limited number of records
    public static function get(int $uantity): array
    {
        $query = "SELECT * FROM " . static::$table . " LIMIT " . $uantity;

        $result = self::consultSQL($query);

        return $result;
    }

      // Get a record by ID
      public static function find(int|string $id): ?static {
        $query = "SELECT * FROM " . static::$table . " WHERE id = {$id}";

        $result = self::consultSQL($query);

        return array_shift($result);
    }
    // Get a record by ID (alternative method)
    public static function SQL(string $query): array {
        $result = self::consultSQL($query);
        return $result;
    }

    // Execute a SQL query and return the results as an array of objects
    public static function consultSQL(string $query): array
    {
        // Consult the database
        $result = self::$db->query($query);

        // Iterate over the results and create an array of objects
        $array = [];
        while ($register = $result->fetch_assoc()) {
            $array[] = static::createObject($register);
        }
        // Free the memory used by the result set
        $result->free();

        // Return the array of objects
        return $array;
    }

    // Create an object of the current class from a database record
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

    //Synchronize the object with the data from an array
    public function sync($args = [])
    {
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
}