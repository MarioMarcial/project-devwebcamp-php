<fieldset class="form__fieldset">
  <legend class="form__legend">Información Personal</legend>
  <div class="form__group">
    <label for="name" class="form__label">Nombre:</label>
    <input type="text" class="form__input" name="name" id="name" placeholder="Nombre Ponente" value="<?php echo $speaker->name ?? ''; ?>">
  </div>
  <div class="form__group">
    <label for="lastname" class="form__label">Apellido:</label>
    <input type="text" class="form__input" name="lastname" id="lastname" placeholder="Apellido Ponente" value="<?php echo $speaker->lastname ?? ''; ?>">
  </div>
  <div class="form__group">
    <label for="city" class="form__label">Ciudad:</label>
    <input type="text" class="form__input" name="city" id="city" placeholder="Ciudad Ponente" value="<?php echo $speaker->city ?? ''; ?>">
  </div>
  <div class="form__group">
    <label for="country" class="form__label">País:</label>
    <input type="text" class="form__input" name="country" id="country" placeholder="País Ponente" value="<?php echo $speaker->country ?? ''; ?>">
  </div>
  <div class="form__group">
    <label for="country" class="form__label">Imagen:</label>
    <input type="file" class="form__input form__input--file" name="image" id="image">
  </div>
</fieldset>
<fieldset class="form__fieldset">
  <legend class="form__legend">Información Extra</legend>
  <div class="form__group">
    <label for="tags_input" class="form__label">Áreas de Experiencia (separadas por coma):</label>
    <input type="text" class="form__input" id="tags_input" placeholder="Ej. Node.js, PHP, CSS, Laravel, UX / UI">
    <div id="tags" class="form__list">
      <input type="hidden" name="tags" value="<?php echo $speaker->tags ?? ''; ?>">
    </div>
  </div>
</fieldset>
<fieldset class="form__fieldset">
  <legend class="form__legend">Redes Sociales</legend>
  <div class="form__group">
    <div class="form__container-icon">
      <div class="form__icon">
        <i class="fa-brands fa-facebook"></i>
      </div>
      <input type="text" class="form__input form__input--socials" name="socials[facebook]" placeholder="Facebook" value="<?php echo $speaker->facebook ?? ''; ?>">
    </div>
  </div>
  <div class="form__group">
    <div class="form__container-icon">
      <div class="form__icon">
        <i class="fa-brands fa-twitter"></i>
      </div>
      <input type="text" class="form__input form__input--socials" name="socials[twitter]" placeholder="Twitter" value="<?php echo $speaker->twitter ?? ''; ?>">
    </div>
  </div>
  <div class="form__group">
    <div class="form__container-icon">
      <div class="form__icon">
        <i class="fa-brands fa-youtube"></i>
      </div>
      <input type="text" class="form__input form__input--socials" name="socials[youtube]" placeholder="Youtube" value="<?php echo $speaker->youtube ?? ''; ?>">
    </div>
  </div>
  <div class="form__group">
    <div class="form__container-icon">
      <div class="form__icon">
        <i class="fa-brands fa-instagram"></i>
      </div>
      <input type="text" class="form__input form__input--socials" name="socials[instagram]" placeholder="Instagram" value="<?php echo $speaker->instagram ?? ''; ?>">
    </div>
  </div>
  <div class="form__group">
    <div class="form__container-icon">
      <div class="form__icon">
        <i class="fa-brands fa-tiktok"></i>
      </div>
      <input type="text" class="form__input form__input--socials" name="socials[tiktok]" placeholder="Tiktok" value="<?php echo $speaker->tiktok ?? ''; ?>">
    </div>
  </div>
  <div class="form__group">
    <div class="form__container-icon">
      <div class="form__icon">
        <i class="fa-brands fa-github"></i>
      </div>
      <input type="text" class="form__input form__input--socials" name="socials[github]" placeholder="Github" value="<?php echo $speaker->github ?? ''; ?>">
    </div>
  </div>
</fieldset>