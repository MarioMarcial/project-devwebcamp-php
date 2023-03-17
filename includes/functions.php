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
function is_auth() : bool {
  if(!isset($_SESSION)){
    session_start();
  } 
  return isset($_SESSION['name']) && !empty($_SESSION);
}

function is_admin() : bool {
  if(!isset($_SESSION)){
    session_start();
  } 
  return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
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