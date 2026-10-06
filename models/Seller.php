<?php

namespace Model;

class Seller extends ActiveRecord {
    protected static $table = 'sellers';
    protected static $columnsDB = ['id', 'name', 'lastName', 'image', 'phone', 'email'];

    public ?int $id = null;
    public string $name = '';
    public string $lastName = '';
    public ?string $image = '';
    public string $phone = '';
    public string $email = '';

    // Constructor to initialize the seller object with default values or provided arguments
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastName = $args['lastName'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->email = $args['email'] ?? '';
    }

    // Validation method to check if the seller data is valid
    public function validate()
    {
        if (!$this->name) {
            self::$alerts['error'][] = t('El nombre es necesario');
        }

        if (!$this->lastName) {
            self::$alerts['error'][] = t('El apellido es necesario');
        }

        if (!$this->image) {
            self::$alerts['error'][] = t('La imagen es necesaria');
        }

        if (!$this->phone) {
            self::$alerts['error'][] = t('El teléfono es necesario');
        }

        if (!$this->email) {
            self::$alerts['error'][] = t('El E-mail es necesario');
        }

        return self::$alerts;
    }
}