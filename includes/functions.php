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
function is_auth() : void {
  if(!isset($_SESSION['login'])) {
    header('Location: /');
  }
}

// Only start a session if it has not been initialized beforehand
function start_session() {
  if(!isset($_SESSION)){
    session_start();
  }  
}

function current_page($path) : bool {
  return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}
?>