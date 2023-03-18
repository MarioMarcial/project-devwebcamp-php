<?php 
  include_once __DIR__ . '/conferences.php';
?>

<section class="summary">
  <div class="summary__grid">
    <div class="summary__block">
      <p class="summary__text summary__text--num"><?php echo $total_speakers;?></p>
      <p class="summary__text">Speakers</p>
    </div>
    <div class="summary__block">
      <p class="summary__text summary__text--num"><?php echo $total_conferences; ?></p>
      <p class="summary__text">Conferencias</p>
    </div>
    <div class="summary__block">
      <p class="summary__text summary__text--num"><?php echo $total_workshops; ?></p>
      <p class="summary__text">Workshops</p>
    </div>
    <div class="summary__block">
      <p class="summary__text summary__text--num">18</p>
      <p class="summary__text">Asistentes</p>
    </div>
  </div>
</section>
<section class="speakers">
  <h2 class="speakers__heading">Speakers</h2>
  <p class="speakers__description">Conoce a nuestros expertos de DevWebCamp</p>
  <?php foreach ($speakers as $speaker) { ?>
    <div class="speaker">
      <picture>
        <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image;?>.webp" type="image/webp">
        <source srcset="/img/speakers/<?php echo $speaker->image;?>.png" type="image/png">
        <img class="speaker__image" loading="lazy" width="200" height="300" src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image;?>.png" alt="Imagen Ponente">
      </picture>
      <div class="speaker__info">
        <h4 class="speaker__name"><?php echo $speaker->name . " " . $speaker->lastname; ?></h4>
        <p class="speaker__location"><?php echo $speaker->city . ", " . $speaker->country; ?></p>
        <nav class="speaker__socials">
          <?php $socials = json_decode($speaker->socials); ?>
          <!-- Facebook -->
          <?php if(!empty($socials->facebook)) { ?> 
            <a class="speaker__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->facebook; ?>">
              <span class="speaker__hide">Facebook</span>
            </a> 
          <?php } ?>
          <!-- Twitter -->
          <?php if(!empty($socials->twitter)) { ?>
            <a class="speaker__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->twitter; ?>">
              <span class="speaker__hide">Twitter</span>
            </a>
          <?php } ?> 
          <!-- Youtube -->
          <?php if(!empty($socials->twitter)) { ?>
            <a class="speaker__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->youtube; ?>">
              <span class="speaker__hide">YouTube</span>
            </a> 
          <?php } ?>
          <!-- Instagram -->
          <?php if(!empty($socials->instagram)) { ?>
            <a class="speaker__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->instagram; ?>">
              <span class="speaker__hide">Instagram</span>
            </a> 
          <?php } ?>
          <!-- TikTok -->
          <?php if(!empty($socials->tiktok)) { ?>
            <a class="speaker__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->tiktok;?>">
              <span class="speaker__hide">Tiktok</span>
            </a> 
          <?php } ?>
          <!-- GitHub -->
          <?php if(!empty($socials->github)) { ?>
            <a class="speaker__link" rel="noopener noreferrer" target="_blank" href="<?php echo $socials->github; ?>">
              <span class="speaker__hide">GitHub</span>
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
</section>