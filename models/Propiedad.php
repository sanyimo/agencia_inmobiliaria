<?php

namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades';

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'superficie', 'habitaciones', 'wc', 'aparcamiento', 'creado', 'vendedorId'];

    public ?int $id;
    public string $titulo;
    public int|string $precio;
    public ?string $imagen;
    public string $descripcion;
    public int|string $superficie;
    public int|string $habitaciones;
    public int|string $wc;
    public int|string $aparcamiento;
    public string $creado;
    public int|string $vendedorId;

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
            self::$alertas['error'][] = "Hace falta un título";
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'El precio es necesario';
        }
        if( strlen( $this->descripcion ) < 150 ) {
            self::$alertas['error'][] = 'La descripción es necesaria y debe tener al menos 150 caracteres';
        }
        if(!$this->habitaciones) {
            self::$alertas['error'][] = 'El número de habitaciones es necesario';
        }  
        if(!$this->wc) {
            self::$alertas['error'][] = 'El número de baños es necesario';
        }
        if(!$this->superficie) {
            self::$alertas['error'][] = 'El número de m2 es necesario';
        }
        if(!$this->vendedorId) {
            self::$alertas['error'][] = 'Elige un/a vendedor/a';
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'La imagen es necesaria';
        }
        return self::$alertas;
    }
}