<?php 
namespace Model;
class ActiveRecord {
  // Database
  protected static $db;
  protected static $table;
  protected static $dbColumns = [];

  // Messages & Alerts
  protected static $alerts = [];

  // Definition of database connection - includes/database.php
  public static function setDB($database){
    self::$db = $database;
  }

  public static function setAlert($type, $message){
    static::$alerts[$type][] = $message;
  }

  // Validation
  public static function getAlerts(){
    return static::$alerts;
  }
  
  public function validate() {
    static::$alerts = [];
    return static::$alerts;
  }

  // Crud
  public function save(){
    $result = '';
    if(!is_null($this->id)){
      // update
      $result = $this->update();
    } else {
      // Create a new record
      $result = $this->create();
    }
    return $result;
  }

  // All records
  public static function all($order = 'DESC'){
    $query = "SELECT * FROM " . static::$table . " ORDER BY id ${order}";
    $result = self::sqlQuery($query);
    return $result;
  }

  // Search a record by its id
  public static function find($id) {
    $query = "SELECT * FROM " . static::$table  ." WHERE id = ${id}";
    $result = self::sqlQuery($query);
    return array_shift($result) ;
  }

   // Get a number of results
  public static function get($limit) {
    $query = "SELECT * FROM " . static::$table . " LIMIT ${limit}";
    $result = self::sqlQuery($query);
    return array_shift( $result ) ;
  }

   // Paginate records
   public static function paginate($per_page, $offset) {
    $query = "SELECT * FROM " . static::$table . " ORDER BY id DESC LIMIT ${per_page} offset ${offset} ";
    $result = self::sqlQuery($query);
    return $result ;
  }

  // Search a specific record
  public static function where($column, $value) {
    $query = "SELECT * FROM " . static::$table  ." WHERE ${column} = '${value}'";
    $result = self::sqlQuery($query);
    return array_shift($result);
  }

  // Return records by an order
  public static function order($column, $order) {
    $query = "SELECT * FROM " . static::$table  ." ORDER BY ${column} ${order}";
    $result = self::sqlQuery($query);
    return $result;
  }

  // Search Where with multiple options
  public static function whereArray($array = []) {
    $query = "SELECT * FROM " . static::$table  ." WHERE ";
    foreach ($array as $key => $value) {
      if($key === array_key_last($array)) {
        $query .= "${key} = '${value}'";
      } else {
        $query .= "${key} = '${value}' AND ";
      }
    }
    $result = self::sqlQuery($query);
    return $result;
  }

  // Get total records
  public static function total() {
    $query = "SELECT COUNT(*) FROM " . static::$table;
    $result = self::$db->query($query);
    $total = $result->fetch_array();
    return array_shift($total);
  }

  // Find all records belonging to id
  public static function belongsTo($column, $value) {
    $query = "SELECT * FROM " . static::$table  ." WHERE ${column} = '${value}'";
    $result = self::sqlQuery($query);
    return $result;
  }

  // flat sql query (use when model methods aren't sufficient)
  public static function SQL($query) {
    $result = self::sqlQuery($query);
    return $result;
  }

  // Create a new record
  public function create() {
    // data sanitize
    $attributes = $this->dataSanitize();

    // Insert to database
    $query = " INSERT INTO " . static::$table . " (";
    $query .= join(', ', array_keys($attributes));
    $query .= ") VALUES ('"; 
    $query .= join("', '", array_values($attributes));
    $query .= "') ";
    // for debug in postman
    // return json_encode(['query' => $query]);

    // Result of the query
    $result = self::$db->query($query);
    return [
        'result' =>  $result,
        'id' => self::$db->insert_id
    ];
  }

  // Update a record
  public function update() {
    // data sanitize
    $attributes = $this->dataSanitize();

    // Iterate to add each field in the DB
    $values = [];
    foreach($attributes as $key => $value) {
        $values[] = "{$key}='{$value}'";
    }

    // SQL Query
    $query = "UPDATE " . static::$table ." SET ";
    $query .=  join(', ', $values );
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1 "; 

    // Update the bd
    $result = self::$db->query($query);
    return $result;
  }

  // Delete a record
  public function delete() {
    $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $result = self::$db->query($query);
    return $result;
  }
  
  // query to create an object in memory
  public static function sqlQuery($query){
    // Consult to database
    $result = self::$db->query($query);

    // Iterate over the results
    $array = [];
    while($record = $result->fetch_assoc()) {
      $array[] = static::createObject($record);
    }

    // Memory release
    $result->free();

    // Return of results
    return $array;
  }

  // creates an in-memory object identical to the one in the database
  protected static function createObject($record) {
    $object = new static;
    foreach($record as $key => $value) {
      if(property_exists($object, $key)){
        $object->$key = $value;
      }
    }
    return $object;
  }

  // unifies and links the attributes of the bd
  public function attributes(){
    $attributes = [];
    foreach(static::$dbColumns as $column){
      if($column === 'id') continue;
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  } 

  // sanitizes data before saving to the bd
  public function dataSanitize(){
    $attributes = $this->attributes();
    $sanitized = [];
    foreach($attributes as $key => $value){
      $sanitized[$key] = self::$db->escape_string($value);
    } 
    return $sanitized;
  }

  // sync the database with objects in memory
  public function sync($args=[]){
    foreach($args as $key => $value){
      if(property_exists($this, $key) && !is_null($value)){
        $this->$key = $value;
      }
    }
  }
}
?>