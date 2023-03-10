<?php
namespace Controllers;

use Classes\Pagination;
use MVC\Router;
use Model\Speaker;
use Intervention\Image\ImageManagerStatic as Image;

class SpeakersController {
  public static function index(Router $router) {
    if(!is_admin()) {      
      header('Location: /login');
    }
    // Pagination
    $current_page = filter_var($_GET['page'], FILTER_VALIDATE_INT);
    if(!$current_page || $current_page < 1) {
      header('Location: /admin/ponentes?page=1');
    }
    $records_per_page = 4;
    $total_records = Speaker::total();
    $pagination = new Pagination($current_page, $records_per_page, $total_records);
    if($current_page > $pagination->total_pages()) {
      header('Location: /admin/ponentes?page=1');
    }
    // Get speakers
    $speakers = Speaker::paginate($records_per_page, $pagination->offset());
    $router->render('admin/speakers/index', [
      'title' => 'Ponentes / Conferencistas',
      'speakers' => $speakers,
      'pagination' => $pagination->pagination()
    ]);
  }

  public static function create(Router $router) {
    if(!is_admin()) {      
      header('Location: /login');
    }
    $alerts = [];
    $speaker = new Speaker;
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_admin()) {      
        header('Location: /login');
      }
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
      'speaker' => $speaker,
      'socials' => json_decode($speaker->socials)
    ]);
  }

  public static function edit(Router $router) {
    if(!is_admin()) {      
      header('Location: /login');
    }
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

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_admin()) {      
        header('Location: /login');
      }
      // New image
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
      } else {
        $_POST['image'] = $speaker->current_image;
      }

      $_POST['socials'] = json_encode($_POST['socials'], JSON_UNESCAPED_SLASHES);
      $speaker->sync($_POST);
      $alerts = $speaker->validate();
      if(empty($alerts)) {
        // If there is a new image then, create the following images
        if(isset($name_image)) {
          // Delete prev image
          unlink($image_folder . '/' . $speaker->current_image . ".png" );
          unlink($image_folder . '/' . $speaker->current_image . ".webp" );

          // Save the new image
          $png_image->save($image_folder . '/' . $name_image . ".png");
          $png_image->save($image_folder . '/' . $name_image . ".webp");
        }

        $result = $speaker->save();
        if($result) {
          Speaker::setAlert('success', 'Ponente Actualizado');
          header('Refresh 2: /admin/ponentes/editar?id=' . $speaker->id);
        }
      }
    }
    $alerts = Speaker::getAlerts();
    $router->render('admin/speakers/edit', [
      'title' => 'Editar Ponente',
      'alerts' => $alerts,
      'speaker' => $speaker,
      'socials' => json_decode($speaker->socials)
    ]);
  }

  public static function delete() {
    if(!is_admin()) {      
      header('Location: /login');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_admin()) {      
        header('Location: /login');
      }
      $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
      $speaker = Speaker::find($id);
      if(isset($speaker)) {
        header('Location: /admin/ponentes');
      }
      $result = $speaker->delete();
      if($result) {
        header('Location: /admin/ponentes');
      }
    }
  }
}