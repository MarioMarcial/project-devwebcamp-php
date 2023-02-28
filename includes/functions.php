<?php

function debug($variable) : string {
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  exit;
}

function sanitize($html) : string {
  $s = htmlspecialchars($html);
  return $s;
}

// Function that checks that the user is authenticated.
function isAuth() : void {
  if(!isset($_SESSION['login'])) {
    header('Location: /');
  }
}

// Only start a session if it has not been initialized beforehand
function startSession() {
  if(!isset($_SESSION)){
    session_start();
  }  
}
?>