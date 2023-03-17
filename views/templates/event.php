<div class="event swiper-slide">
  <p class="event__hour"><?php echo $event->hour->hour; ?></p>
  <div class="event__info">
    <h4 class="event__name"><?php echo $event->name; ?></h4>
    <p class="event__introduction"><?php echo $event->description; ?></p>
    <div class="event__autor-info">
      <picture>
        <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $event->speaker->image;?>.webp" type="image/webp">
        <source srcset="/img/speakers/<?php echo $event->speaker->image;?>.png" type="image/png">
        <img class="event__image-autor" loading="lazy" width="200" height="300" src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $event->speaker->image;?>.png" alt="Imagen Ponente">
      </picture>

      <p class="event__autor-name">
        <?php echo $event->speaker->name . " " . $event->speaker->lastname; ?>
      </p>
    </div>
  </div>
</div>