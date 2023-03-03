<main class="auth">
  <h2 class="auth__heading"><?php echo $title; ?></h2>
  <p class="auth__description">Inicia sesión en DevWebCamp</p>
  <?php require_once __DIR__ . '/../templates/alerts.php' ?>
  <form action="/login" class="form" method="POST">
    <div class="form__group">
      <label for="email" class="form__label">Email:</label>
      <input type="email" class="form__input" name="email" id="email" placeholder="Tu Email">
    </div>
    <div class="form__group">
      <label for="password" class="form__label">Password:</label>
      <input type="password" class="form__input" name="password" id="password" placeholder="Tu Password">
    </div>
    <input type="submit" class="form__submit" value="Iniciar Sesión">
  </form>
  <div class="actions">
    <a class="actions__link" href="/registro">¿Aún no tienes cuenta? Crear una</a>
    <a class="actions__link" href="/olvide">¿Olvidaste tu password?</a>
  </div>
</main>