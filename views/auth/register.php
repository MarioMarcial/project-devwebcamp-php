<main class="auth">
  <h2 class="auth__heading"><?php echo $title; ?></h2>
  <p class="auth__description">Registrate en DevWebCamp</p>
  <form action="" class="form" method="POST">
    <div class="form__group">
      <label for="name" class="form__label">Nombre:</label>
      <input type="text" class="form__input" name="name" id="name" placeholder="Tu Nombre">
    </div>
    <div class="form__group">
      <label for="lastname" class="form__label">Apellido:</label>
      <input type="text" class="form__input" name="lastname" id="lastname" placeholder="Tu Apellido">
    </div>
    <div class="form__group">
      <label for="email" class="form__label">Email:</label>
      <input type="email" class="form__input" name="email" id="email" placeholder="Tu Email">
    </div>
    <div class="form__group">
      <label for="password" class="form__label">Password:</label>
      <input type="password" class="form__input" name="password" id="password" placeholder="Tu Password">
    </div>
    <div class="form__group">
      <label for="repassword" class="form__label">Repetir Password:</label>
      <input type="password" class="form__input" name="repassword" id="repassword" placeholder="Repetir Password">
    </div>
    <input type="submit" class="form__submit" value="Crear Cuenta">
  </form>
  <div class="actions">
    <a class="actions__link" href="/login">¿Ya tienes cuenta? Inicia Sesión</a>
    <a class="actions__link" href="/olvide">¿Olvidaste tu password?</a>
  </div>
</main>