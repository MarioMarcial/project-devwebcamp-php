<main class="auth">
  <h2 class="auth__heading"><?php echo $title; ?></h2>
  <p class="auth__description">Recupera tu acceso a DevWebCamp</p>
  <form action="" class="form" method="POST">
    <div class="form__group">
      <label for="email" class="form__label">Email:</label>
      <input type="email" class="form__input" name="email" id="email" placeholder="Tu Email">
    </div>
    <input type="submit" class="form__submit" value="Enviar Instrucciones">
  </form>
  <div class="actions">
    <a class="actions__link" href="/login">¿Ya tienes cuenta? Inicia Sesión</a>
    <a class="actions__link" href="/registro">¿Aún no tienes cuenta? Crear una</a>
  </div>
</main>