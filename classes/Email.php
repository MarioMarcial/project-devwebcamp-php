<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;
class Email {
  protected $email;
  protected $name;
  protected $token;

  public function __construct($email, $name, $token)
  {
    $this->email = $email;
    $this->name = $name;
    $this->token = $token;
  }

  public function sendConfirmation() {
    // Template
    $template = file_get_contents('../views/templates/email-confirm-account-inline.php');
    $template = str_replace('%name%', $this->name, $template);
    $template = str_replace('%token%', $this->token, $template);

    // create a new object
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username = $_ENV['EMAIL_USER'];
    $mail->Password = $_ENV['EMAIL_PASS'];

    $mail->setFrom('defaultmart@gmail.com', 'Mario Dev');
    $mail->addAddress($this->email, $this->name . " User");
    $mail->Subject = 'Confirma tu cuenta';

    // Set HTML
    $mail->isHTML(TRUE);
    $mail->CharSet = 'UTF-8';
    $mail->Body = $template;

    // Send email
    $mail->send();
  }

  public function sendInstructions() {
    // Template
    $template = file_get_contents('../views/templates/email-reset-password-inline.php');
    $template = str_replace('%name%', $this->name, $template);
    $template = str_replace('%token%', $this->token, $template);

    // create a new object
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username = $_ENV['EMAIL_USER'];
    $mail->Password = $_ENV['EMAIL_PASS'];

    $mail->setFrom('defaultmart@gmail.com', 'Mario Dev');
    $mail->addAddress($this->email, $this->name . " User");
    $mail->Subject = 'Restablecer Password';

    // Set HTML
    $mail->isHTML(TRUE);
    $mail->CharSet = 'UTF-8';
    $mail->Body = $template;

    // Send email
    $mail->send();
  }
}