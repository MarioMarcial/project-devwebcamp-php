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
    <label for="category">Tipo Evento:</label>
    <select id="category" name="category_id" class="form__input form__input--select">
      <option value="" disabled selected>- Seleccionar -</option>
      <?php foreach ($categories as $category) { ?>
        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form__group">
    <label for="day">Selecciona el día:</label>
    <div class="form__radio">
      <?php foreach ($days as $day) { ?>
        <div class="form__radio-content">
          <label for="<?php echo strtolower($day->name); ?>" class="form__label">
            <?php echo $day->name; ?>
          </label>
          <input type="radio" 
            class="form__input-radio"
            id="<?php echo strtolower($day->name); ?>"
            name="day"
            value="<?php echo $day->id; ?>"
          >
        </div>
      <?php } ?>
    </div>
  </div>
  <div id="hours" class="form__group">
    <label class="form__label">Seleccionar Hora:</label>
    <ul class="hours">
      <?php foreach ($hours as $hour) { ?>
        <li class="hours__hour">
          <?php echo $hour->hour; ?>
        </li>
      <?php } ?>
    </ul>
  </div>
</fieldset>