<?php 
  include_once __DIR__ . '/conferences.php';
?>
<!-- Summary -->
<section class="summary" <?php echo aos_animation();?>>
  <div class="summary__grid">
    <div class="summary__block" <?php echo aos_animation();?>>
      <p class="summary__text summary__text--num"><?php echo $total_speakers;?></p>
      <p class="summary__text">Speakers</p>
    </div>
    <div class="summary__block" <?php echo aos_animation();?>>
      <p class="summary__text summary__text--num"><?php echo $total_conferences; ?></p>
      <p class="summary__text">Conferencias</p>
    </div>
    <div class="summary__block" <?php echo aos_animation();?>>
      <p class="summary__text summary__text--num"><?php echo $total_workshops; ?></p>
      <p class="summary__text">Workshops</p>
    </div>
    <div class="summary__block" <?php echo aos_animation();?>>
      <p class="summary__text summary__text--num">18</p>
      <p class="summary__text">Asistentes</p>
    </div>
  </div>
</section>

<!-- Speakers -->
<section class="speakers">
  <h2 class="speakers__heading">Speakers</h2>
  <p class="speakers__description">Conoce a nuestros expertos de DevWebCamp</p>
  <div class="speakers__grid">
    <?php foreach ($speakers as $speaker) { ?>
      <div class="speaker" <?php aos_animation();?>>
        <picture>
          <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image;?>.webp" type="image/webp">
          <source srcset="/img/speakers/<?php echo $speaker->image;?>.png" type="image/png">
          <img class="speaker__image" loading="lazy" width="200" height="300" src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image;?>.png" alt="Imagen Ponente">
        </picture>
        <div class="speaker__info">
          <h4 class="speaker__name"><?php echo $speaker->name . " " . $speaker->lastname; ?></h4>
          <p class="speaker__location"><?php echo $speaker->city . ", " . $speaker->country; ?></p>
          <nav class="speaker-socials">
            <?php $socials = json_decode($speaker->socials); ?>
            <!-- Facebook -->
            <?php if(!empty($socials->facebook)) { ?> 
              <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->facebook; ?>">
                <span class="speaker-socials__hide">Facebook</span>
              </a> 
            <?php } ?>
            <!-- Twitter -->
            <?php if(!empty($socials->twitter)) { ?>
              <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->twitter; ?>">
                <span class="speaker-socials__hide">Twitter</span>
              </a>
            <?php } ?> 
            <!-- Youtube -->
            <?php if(!empty($socials->youtube)) { ?>
              <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->youtube; ?>">
                <span class="speaker-socials__hide">YouTube</span>
              </a> 
            <?php } ?>
            <!-- Instagram -->
            <?php if(!empty($socials->instagram)) { ?>
              <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->instagram; ?>">
                <span class="speaker-socials__hide">Instagram</span>
              </a> 
            <?php } ?>
            <!-- TikTok -->
            <?php if(!empty($socials->tiktok)) { ?>
              <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->tiktok;?>">
                <span class="speaker-socials__hide">Tiktok</span>
              </a> 
            <?php } ?>
            <!-- GitHub -->
            <?php if(!empty($socials->github)) { ?>
              <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->github; ?>">
                <span class="speaker-socials__hide">GitHub</span>
              </a>
            <?php } ?>
          </nav>
          <ul class="speaker__skill-set">
            <?php $tags = explode(',', $speaker->tags); ?>
            <?php foreach ($tags as $tag) { ?>
              <li class="speaker__skill"><?php echo $tag; ?></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<!-- Map -->
<div id="map" class="map">
</div>

<!-- Tickets -->
<section class="tickets">
  <h2 class="tickets__heading">Boletos & Precios</h2>
  <p class="tickets__description">Precios para DevWebCamp</p>
  <div class="tickets__grid">
    <div class="ticket ticket--inperson">
      <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
      <p class="ticket__plan">Presencial</p>
      <p class="ticket__price">$199</p>
    </div>
    <div class="ticket ticket--virtual">
      <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
      <p class="ticket__plan">Virtual</p>
      <p class="ticket__price">$49</p>
    </div>
    <div class="ticket ticket--free">
      <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
      <p class="ticket__plan">Gratis</p>
      <p class="ticket__price">$0</p>
    </div>
  </div>
  <div class="ticket__link-container">
    <a href="/paquetes" class="ticket__link">Ver Paquetes</a>
  </div>
</section>