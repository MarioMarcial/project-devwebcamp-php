<?php
namespace Model;

class Event extends ActiveRecord {
  protected static $table = 'events';
  protected static $dbColumns = ['id', 'name', 'description', 'availables', 'category_id', 'day_id', 'hour_id', 'speaker_id'];

  public $id;
  public $name;
  public $description;
  public $availables;
  public $category_id;
  public $day_id;
  public $hour_id;
  public $speaker_id;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->availables = $args['availables'] ?? '';
    $this->category_id = $args['category_id'] ?? '';
    $this->day_id = $args['day_id'] ?? '';
    $this->hour_id = $args['hour_id'] ?? '';
    $this->speaker_id = $args['speaker_id'] ?? '';
  }
  
  // Mensajes de validación para la creación de un evento
  public function validate() {
    if(!$this->name) {
      self::$alerts['error'][] = 'El Nombre es Obligatorio';
    }
    if(!$this->description) {
      self::$alerts['error'][] = 'La descripción es Obligatoria';
    }
    if(!$this->category_id  || !filter_var($this->category_id, FILTER_VALIDATE_INT)) {
      self::$alerts['error'][] = 'Elige una Categoría';
    }
    if(!$this->day_id  || !filter_var($this->day_id, FILTER_VALIDATE_INT)) {
      self::$alerts['error'][] = 'Elige el Día del evento';
    }
    if(!$this->hour_id  || !filter_var($this->hour_id, FILTER_VALIDATE_INT)) {
      self::$alerts['error'][] = 'Elige la hora del evento';
    }
    if(!$this->availables  || !filter_var($this->availables, FILTER_VALIDATE_INT)) {
      self::$alerts['error'][] = 'Añade una cantidad de Lugares Disponibles';
    }
    if(!$this->speaker_id || !filter_var($this->speaker_id, FILTER_VALIDATE_INT) ) {
      self::$alerts['error'][] = 'Selecciona la persona encargada del evento';
    }

    return self::$alerts;
  }
}
?>