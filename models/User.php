<?php
namespace Model;
class User extends ActiveRecord {
  protected static $table = 'users';
  protected static $dbColumns = ['id', 'name', 'lastname', 'email', 'password', 'confirmed', 'token', 'admin'];

  // This code block is optional
  public $id;
  public $name;
  public $lastname;
  public $email;
  public $password;
  public $repassword;
  public $confirmed;
  public $token; 
  public $admin; 

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->lastname = $args['lastname'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->repassword = $args['repassword'] ?? '';
    $this->confirmed = $args['confirmed'] ?? 0;
    $this->token = $args['token'] ?? '';
    $this->admin = $args['admin'] ?? '';
  }

  public function validateLogin() : array {
    if(!$this->password) {
      self::$alerts['error'][] = 'El password es obligatorio';
    }
    if(!$this->email) {
      self::$alerts['error'][] = 'El email es obligatorio';
    }
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      self::$alerts['error'][] = 'Email no válido';
    }
    return self::$alerts;
  }

  public function validateNewAccount() : array{
    if(!$this->name) {
      self::$alerts['error'][] = 'El nombre es obligatorio';
    }
    if(!$this->lastname) {
      self::$alerts['error'][] = 'El apellido es obligatorio';
    }
    if(!$this->email) {
      self::$alerts['error'][] = 'El email es obligatorio';
    }
    if(!$this->password) {
      self::$alerts['error'][] = 'El password es obligatorio';
    }
    if(!preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $this->password)){
      self::$alerts['error'][] = 'El password debe contener al menos 8 caracteres, una letra mayúscula y un dígito';
    }
    if($this->repassword !== $this->password) {
      self::$alerts['error'][] = 'Los passwords son diferentes';
    }
    return self::$alerts;
  }

  public function validateEmail() : array {
    if(!$this->email) {
      self::$alerts['error'][] = 'El email es obligatorio';
    }
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      self::$alerts['error'][] = 'Email no válido';
    }
    return self::$alerts;
  }

  // reset password
  public function validateNewPass() : array {
    if(!$this->password) {
      self::$alerts['error'][] = 'El password es obligatorio';
    }
    if(!preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $this->password)){
      self::$alerts['error'][] = 'El password debe contener al menos 8 caracteres, una letra mayúscula, una minúscula y un dígito';
    }
    if($this->repassword !== $this->password) {
      self::$alerts['error'][] = 'Los passwords son diferentes';
    }
    return self::$alerts;
  }

  // Validates the profile
  function validateProfile() : array {
    if(!$this->name) {
      self::$alerts['error'][] = 'El nombre es obligatorio';
    }
    if(!$this->lastname) {
      self::$alerts['error'][] = 'El apellido es obligatorio';
    }
    if(!$this->email) {
      self::$alerts['error'][] = 'El email es obligatorio';
    }
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      self::$alerts['error'][] = 'Email no válido';
    }
    return self::$alerts;
  }

  public function changePassword() : array {
    if(!$this->new_password) {
      self::$alerts['error'][] = 'El password nuevo es obligatorio';
    }
    if(!preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $this->new_password)){
      self::$alerts['error'][] = 'El nuevo password debe contener al menos 8 caracteres, una letra mayúscula y un dígito';
    }
    if($this->new_password !== $this->renew_password) {
      self::$alerts['error'][] = 'La confirmación del nuevo password es incorrecta';
    }
    if(!password_verify($this->current_password, $this->password)) {
      self::$alerts['error'][] = 'Password actual incorrecto';
    }
    return self::$alerts;
  }

  // reset password - the old password can't be the new
  public function checkPasswords($password) : bool {
    $result = password_verify($password, $this->password);
    return $result;
  }

  // password hashing
  public function hashPassword() : void {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  // Create token
  public function createToken() : void {
    $this->token = uniqid();
  }
}
?>