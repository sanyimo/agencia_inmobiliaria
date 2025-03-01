<?php

namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades';

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'superficie', 'habitaciones', 'wc', 'aparcamiento', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $superficie;
    public $habitaciones;
    public $wc;
    public $aparcamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->superficie = $args['superficie'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->aparcamiento = $args['aparcamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Falta el título";
        }
    
        if(!$this->precio) {
            self::$errores[] = 'El precio es obligatorio';
        }

        if (strlen($this->descripcion) < 150) {
            self::$errores[] = 'La descripción es necesaria y debe tener al menos 150 caracteres';
        }
    
        if(!$this->habitaciones) {
            self::$errores[] = 'Falta el número de habitaciones';
        }
        
        if(!$this->wc) {
            self::$errores[] = 'Falta el número de baños';
        }
    
        if(!$this->superficie) {
            self::$errores[] = 'Falta el número de m2';
        }
        
        if(!$this->vendedorId) {
            self::$errores[] = 'Elige un/a vendedor/a';
        }
    
        if(!$this->imagen) {
            self::$errores[] = 'Necesitas una imagen';
        }
        
        return self::$errores;
    }

}