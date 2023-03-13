<fieldset class="form__fieldset">
  <legend class="form__legend">Información Evento</legend>
  <div class="form__group">
    <label for="name" class="form__label">Nombre Evento:</label>
    <input type="text" class="form__input" name="name" id="name" placeholder="Nombre Evento" value="<?php echo $event->name ?? ''; ?>">
  </div>
  <div class="form__group">
    <label for="description" class="form__label">Descripción:</label>
    <textarea class="form__input form__input--textarea" name="description" id="description" rows="8" placeholder="Descripción Evento" value="<?php echo $event->description ?? ''; ?>"></textarea>
  </div>
  <div class="form__group">
    <label for="categories">Tipo Evento:</label>
    <select name="categories" id="category" name="category_id" class="form__input form__input--select">
      <option value="" disabled selected>- Seleccionar -</option>
      <?php foreach ($categories as $category) { ?>
        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
      <?php } ?>
    </select>
  </div>
</fieldset>