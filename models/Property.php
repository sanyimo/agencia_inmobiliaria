<?php

namespace Model;

class Property extends ActiveRecord
{
    protected static $table = 'properties';

    protected static $columnsDB = ['id', 'header', 'price', 'image', 'description', 'area', 'bedrooms', 'wc', 'parking', 'created_at', 'sellerId'];

    public ?int $id;
    public string $header;
    public int|string $price;
    public ?string $image;
    public string $description;
    public int|string $area;
    public int|string $bedrooms;
    public int|string $wc;
    public int|string $parking;
    public string $created_at;
    public int|string $sellerId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->header = $args['header'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->area = $args['area'] ?? '';
        $this->bedrooms = $args['bedrooms'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->parking = $args['parking'] ?? '';
        $this->created_at = date('Y/m/d');
        $this->sellerId = $args['sellerId'] ?? '';
    }

    public function validate()
    {
        if (!$this->header) {
            self::$alerts['error'][] = "Hace falta un título";
        }
        if (!$this->price) {
            self::$alerts['error'][] = 'El precio es necesario';
        }
        if (strlen($this->description) < 150) {
            self::$alerts['error'][] = 'La descripción es necesaria y debe tener al menos 150 caracteres';
        }
        if (!$this->bedrooms) {
            self::$alerts['error'][] = 'El número de habitaciones es necesario';
        }  
        if(!$this->wc) {
            self::$alerts['error'][] = 'El número de baños es necesario';
        }
        if (!$this->area) {
            self::$alerts['error'][] = 'El número de m2 es necesario';
        }
        if (!$this->sellerId) {
            self::$alerts['error'][] = 'Elige un/a vendedor/a';
        }
        if (!$this->image) {
            self::$alerts['error'][] = 'La imagen es necesaria';
        }
        return self::$alerts;
    }
}