<h2 class="dashboard__heading"><?php echo $title; ?></h2>
<main class="blocks">
  <div class="blocks__grid">
    <div class="block">
      <h3 class="block__heading">Últimos Registros</h3>
      <?php foreach ($registrations as $registration) { ?>
        <div class="block__content">
          <p class="block__text"><?php echo $registration->user->name . " " . $registration->user->lastname; ?></p>
        </div>
      <?php } ?>
    </div>
    <div class="block">
      <h3 class="block__heading">Ingresos</h3>
      <div class="block__content">
        <p class="block__text--amount">$<?php echo $income; ?></p>
      </div>
    </div>
  </div>
</main>