<main class="auth">
  <h2 class="auth__heading"><?php echo $title; ?></h2>
  <p class="auth__description">Ingresa tu nuevo password</p>
  <?php require_once __DIR__ . '/../templates/alerts.php' ?>
  <?php if($valid_token) { ?>
    <form class="form" method="POST">
      <div class="form__group">
        <label for="password" class="form__label">Password:</label>
        <input type="password" class="form__input" name="password" id="password" placeholder="Tu Nuevo Password">
      </div>
      <div class="form__group">
        <label for="repassword" class="form__label">Repetir Password:</label>
        <input type="password" class="form__input" name="repassword" id="repassword" placeholder="Repite Tu Nuevo Password">
      </div>
      <input type="submit" class="form__submit" value="Guardar Password">
    </form>
  <?php } ?>
  <div class="actions">
    <a class="actions__link" href="/login">¿Ya tienes cuenta? Inicia Sesión</a>
    <a class="actions__link" href="/registro">¿Aún no tienes cuenta? Crear una</a>
  </div>
</main>