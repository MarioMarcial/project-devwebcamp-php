<fieldset class="form__fieldset">
  <legend class="form__legend">Información Evento</legend>
  <div class="form__group">
    <label for="name" class="form__label">Nombre Evento:</label>
    <input type="text" class="form__input" name="name" id="name" placeholder="Nombre Evento" value="<?php echo $event->name ?? ''; ?>">
  </div>
  <div class="form__group">
    <label for="description" class="form__label">Descripción:</label>
    <textarea class="form__input form__input--textarea" 
      name="description" 
      id="description" 
      rows="8"
      placeholder="Descripción Evento"><?php echo $event->description; ?></textarea>
  </div>
  <div class="form__group">
    <label for="category">Tipo Evento:</label>
    <select id="category" name="category_id" class="form__input form__input--select">
      <option value="">- Seleccionar -</option>
      <?php foreach ($categories as $category) { ?>
        <option <?php echo ($event->category_id === $category->id) ? 'selected' : ''; ?> value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
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
            name="day_id"
            value="<?php echo $day->id; ?>"
            <?php echo ($event->day_id === $day->id) ? 'checked' : ''; ?>
          >
        </div>
      <?php } ?>
    </div>
    <input type="hidden" name="day" value="<?php echo $event->day_id; ?>">
  </div>
  <div id="hours" class="form__group">
    <label class="form__label">Seleccionar Hora:</label>
    <ul id="hours" class="hours">
      <?php foreach ($hours as $hour) { ?>
        <li data-hour-id=<?php echo $hour->id; ?> class="hours__hour hours__hour--disabled">
          <?php echo $hour->hour; ?>
        </li>
      <?php } ?>
    </ul>
    <input type="hidden" name="hour_id" value="<?php echo $event->hour_id; ?>">
  </div>
</fieldset>
<fieldset class="form__fieldset">
  <legend class="form__legend">Información Extra:</legend>
  <div class="form__group">
    <label for="speakers" class="form__label">Ponente:</label>
    <input type="text" class="form__input" id="speakers" placeholder="Buscar Ponente">
    <ul id="speakers-list" class="speakers-list">

    </ul>
    <input type="hidden" name="speaker_id" value="<?php echo $event->speaker_id; ?>">
  </div>
  <div class="form__group">
    <label for="availables" class="form__label">Lugares Disponibles:</label>
    <input type="number" min="1" class="form__input" id="availables" name="availables" placeholder="Ej. 20" value="<?php echo $event->availables;?>">
  </div>
</fieldset>