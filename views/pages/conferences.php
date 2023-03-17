<main class="diary">
  <h2 class="diary__heading"><?php echo $title; ?></h2>
  <p class="diary__description">Talleres y Conferencias dictados por expertos en Desarrollor Web</p>
  <div class="events">
    <h3 class="events__heading">&lt; Conferencias/></h3>
    <p class="events__date">Viernes 5 de Octubre</p>
    <div class="events__list slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($events['friday_conferences'] as $event) { ?>
          <?php include __DIR__ . '../../templates/event.php'; ?>
        <?php } ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <p class="events__date">Sábado 6 de Octubre</p>
    <div class="events__list slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($events['saturday_conferences'] as $event) { ?>
          <?php include __DIR__ . '../../templates/event.php'; ?>
        <?php } ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
  <div class="events events--workshops">
    <h3 class="events__heading">&lt;WorkShops/></h3>
    <p class="events__date">Viernes 5 de Octubre</p>
    <div class="events__list slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($events['friday_workshops'] as $event) { ?>
          <?php include __DIR__ . '../../templates/event.php'; ?>
        <?php } ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <p class="events__date">Sábado 6 de Octubre</p>
    <div class="events__list slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($events['saturday_workshops'] as $event) { ?>
          <?php include __DIR__ . '../../templates/event.php'; ?>
        <?php } ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>

  </div>
</main>