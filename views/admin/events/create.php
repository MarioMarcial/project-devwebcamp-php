<h2 class="dashboard__heading"><?php echo $title; ?></h2>
<div class="dashboard__container-button">
  <a class="dashboard__button" href="/admin/eventos">
    <i class="fa-solid fa-circle-plus"></i>
    Volver
  </a>
</div>
<div class="dashboard__form">
  <?php include_once __DIR__ . '../../../templates/alerts.php'; ?> 
  <form class="form" action="/admin/eventos/crear" method="POST">
    <?php include_once __DIR__ . '/form.php'; ?>
    <input type="submit" class="form__submit form__submit--register" value="Registrar Evento">
  </form>
</div>