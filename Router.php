<?php 
namespace MVC;
class Router {
  public array $getRoutes = [];
  public array $postRoutes = [];

  public function get($url, $function){
    $this->getRoutes[$url] = $function;
  }
  public function post($url, $function){
    $this->postRoutes[$url] = $function;
  }
  public function checkRoutes(){
    session_start();
    $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
    $method = $_SERVER['REQUEST_METHOD'];
    if($method === 'GET'){
      $function = $this->getRoutes[$currentUrl] ?? null;
    } else {
      $function = $this->postRoutes[$currentUrl] ?? null;
    }
    // routes protection
    /* if(in_array($currentUrl, $protected_routes) && !$auth){
      header('Location: /');
    } */

    if($function) {
      call_user_func($function, $this);
    } else {
      header('Location: /404');
    }
  }

  public function render($view, $data = []){
    foreach($data as $key => $value){
      $$key = $value;
    }
    // initializes a memory storage
    ob_start();
    include __DIR__ . "/views/$view.php";
    // memory cleaning
    $content = ob_get_clean();

    // Use the layout according to the url
    $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
    if(str_contains($currentUrl, '/admin')) {
      include __DIR__ . "/views/admin-layout.php";
    } else {
      include __DIR__ . "/views/layout.php";
    }
  }
}