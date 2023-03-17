<main class="diary">
  <h2 class="diary__heading"><?php echo $title; ?></h2>
  <p class="diary__description">Talleres y Conferencias dictados por expertos en Desarrollor Web</p>
  <div class="events">
    <h3 class="events__heading">&lt; Conferencias/></h3>
    <p class="events__date">Viernes 5 de Octubre</p>
    <div class="events__list slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($events['friday_conferences'] as $event) { ?>
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
        <?php } ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <p class="events__date">Sábado 6 de Octubre</p>
    <div class="events__list">

    </div>

  </div>
  <div class="events events--workshops">
    <h3 class="events__heading">&lt;WorkShops/></h3>
    <p class="events__date">Viernes 5 de Octubre</p>
    <div class="events__list">

    </div>
    <p class="events__date">Sábado 6 de Octubre</p>
    <div class="events__list">

    </div>

  </div>
</main>