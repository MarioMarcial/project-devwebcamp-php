<h2 class="dashboard__heading"><?php echo $title; ?></h2>
<div class="dashboard__container-button">
  <a class="dashboard__button" href="/admin/eventos">
    <i class="fa-solid fa-circle-arrow-left"></i>
    Volver
  </a>
</div>
<div class="dashboard__form">
  <?php include_once __DIR__ . '../../../templates/alerts.php'; ?> 
  <form class="form" method="POST">
    <?php include_once __DIR__ . '/form.php'; ?>
    <input type="submit" class="form__submit form__submit--register" value="Guardar Cambios">
  </form>
</div>