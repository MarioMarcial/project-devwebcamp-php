<?php
namespace Controllers;

use MVC\Router;
use Model\Speaker;
use Intervention\Image\ImageManagerStatic as Image;

class SpeakersController {
  public static function index(Router $router) {
    $speakers = Speaker::all();
    $router->render('admin/speakers/index', [
      'title' => 'Ponentes / Conferencistas',
      'speakers' => $speakers
    ]);
  }

  public static function create(Router $router) {
    $alerts = [];
    $speaker = new Speaker;
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Read image
      if(!empty($_FILES['image']['tmp_name'])) {
        $image_folder = '../public/img/speakers';
        // Create folder if it dosn't exist
        if(!is_dir($image_folder)) {
          mkdir($image_folder, 0755, true);
        }

        $png_image = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('png', 80);
        $webp_image = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('webp', 80);

        $name_image = md5(uniqid(rand(), true));

        $_POST['image'] = $name_image;
      } 

      $_POST['socials'] = json_encode($_POST['socials'], JSON_UNESCAPED_SLASHES);
      $speaker->sync($_POST);
      // validate
      $alerts = $speaker->validate();
      // Saving images to the server 
      if(empty($alerts)) {
        $png_image->save($image_folder . '/' . $name_image . ".png");
        $png_image->save($image_folder . '/' . $name_image . ".webp");

        // Save speaker to the bd
        $result = $speaker->save();
        if($result) {
          header('Location: /admin/ponentes');
        }
      }
    }
    $router->render('admin/speakers/create', [
      'title' => 'Registrar Ponente',
      'alerts' => $alerts,
      'speaker' => $speaker
    ]);
  }

  public static function edit(Router $router) {
    $alerts = [];
    // Id validation
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
      header('Location: /admin/ponentes');
    }
    // Get speaker data
    $speaker = Speaker::find($id);
    if(!$speaker) {
      header('Location: /admin/ponentes');
    }

    $speaker->current_image = $speaker->image;

    $router->render('admin/speakers/edit', [
      'title' => 'Editar Ponente',
      'alerts' => $alerts,
      'speaker' => $speaker
    ]);
  }
}