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
</fieldset>