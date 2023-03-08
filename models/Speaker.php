<?php 
namespace Model;

class Speaker extends ActiveRecord {
  protected static $table = 'speakers';
  protected static $dbColumns = ['id', 'name', 'lastname', 'city', 'country', 'image', 'tags', 'socials'];

  // This code block is optional
  public $id;
  public $name;
  public $lastname;
  public $city;
  public $country;
  public $image;
  public $tags;
  public $socials;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->lastname = $args['lastname'] ?? '';
    $this->city = $args['city'] ?? '';
    $this->country = $args['country'] ?? '';
    $this->image = $args['image'] ?? '';
    $this->tags = $args['tags'] ?? '';
    $this->socials = $args['socials'] ?? '';
  }

  public function validate() {
    if(!$this->name) {
        self::$alerts['error'][] = 'El Nombre es Obligatorio';
    }
    if(!$this->lastname) {
        self::$alerts['error'][] = 'El Apellido es Obligatorio';
    }
    if(!$this->city) {
        self::$alerts['error'][] = 'El Campo Ciudad es Obligatorio';
    }
    if(!$this->country) {
        self::$alerts['error'][] = 'El Campo País es Obligatorio';
    }
    if(!$this->image) {
        self::$alerts['error'][] = 'La imagen es obligatoria';
    }
    if(!$this->tags) {
        self::$alerts['error'][] = 'El Campo áreas es obligatorio';
    }
    return self::$alerts;
  }
}
?>