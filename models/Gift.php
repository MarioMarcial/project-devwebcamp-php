<?php 
namespace Model;

class Gift extends ActiveRecord {
  protected static $table = 'gifts';
  protected static $dbColumns = ['id', 'name'];

  // This code block is optional
  public $id;
  public $name;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
  }
}
?>