<?php 
  include_once __DIR__ . '/conferences.php';
?>

<section class="summary">
  <div class="summary__grid">
    <div class="summary__block">
      <p class="summary__text summary__text--num"><?php echo $speakers;?></p>
      <p class="summary__text">Speakers</p>
    </div>
    <div class="summary__block">
      <p class="summary__text summary__text--num"><?php echo $conferences; ?></p>
      <p class="summary__text">Conferencias</p>
    </div>
    <div class="summary__block">
      <p class="summary__text summary__text--num"><?php echo $workshops; ?></p>
      <p class="summary__text">Workshops</p>
    </div>
    <div class="summary__block">
      <p class="summary__text summary__text--num">18</p>
      <p class="summary__text">Asistentes</p>
    </div>
  </div>
</section>