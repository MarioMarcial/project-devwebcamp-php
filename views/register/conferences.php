<h2 class="page__heading"><?php echo $title ?></h2>
<p class="page__description">Elige hasta 5 eventos para asistir de forma presencial.</p>
<div class="events-register">
  <main class="events-register__list">
    <h3 class="events-register__heading--conferences">&lt; Conferencias/></h3>
    <p class="events-register__date">Viernes 5 de Octubre</p>
    <div class="events-register__grid">
      <?php foreach($events['friday_conferences'] as $event) { ?>
        <?php include __DIR__ . '/event.php'; ?>
      <?php } ?>
    </div>
    <p class="events-register__date">Sábado 6 de Octubre</p>
    <div class="events-register__grid">
      <?php foreach($events['saturday_conferences'] as $event) { ?>
        <?php include __DIR__ . '/event.php'; ?>
      <?php } ?>
    </div>
    <h3 class="events-register__heading--workshops">&lt; Workshops/></h3>
    <p class="events-register__date">Viernes 5 de Octubre</p>
    <div class="events-register__grid events--workshops">
      <?php foreach($events['friday_workshops'] as $event) { ?>
        <?php include __DIR__ . '/event.php'; ?>
      <?php } ?>
    </div>
    <p class="events-register__date">Sábado 6 de Octubre</p>
    <div class="events-register__grid events--workshops">
      <?php foreach($events['saturday_workshops'] as $event) { ?>
        <?php include __DIR__ . '/event.php'; ?>
      <?php } ?>
    </div>
  </main>
  <aside class="register">
    <h2 class="register__heading">Tu Registro</h2>
    <div id="register-summary" class="register__sumary"></div>
  </aside>
</div>
