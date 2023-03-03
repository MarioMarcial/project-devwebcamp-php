<main class="auth">
  <h2 class="auth__heading"><?php echo $title; ?></h2>
  <p class="auth__description">Tu Cuenta DevWebCamp</p>
  <?php require_once __DIR__ . '/../templates/alerts.php' ?>
  <?php if(isset($alerts['success'])) { ?>
    <div class="actions--center">
      <a class="actions__link" href="/login">Iniciar Sesión</a>
    </div>
  <?php } ?>
</main>