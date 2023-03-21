<?php 
namespace Model;

class Register extends ActiveRecord {
  protected static $table = 'registrations';
  protected static $dbColumns = ['id', 'pack_id', 'payment_id', 'token', 'user_id'];

  // This code block is optional
  public $id;
  public $pack_id;
  public $payment_id;
  public $token;
  public $user_id;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->pack_id = $args['pack_id'] ?? '';
    $this->payment_id = $args['payment_id'] ?? '';
    $this->token = $args['token'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
  }
}
?>