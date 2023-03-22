<main class="page">
  <h2 class="page__heading"><?php echo $title ?></h2>
  <p class="page__description">Tu Boleto - Te recomendamos almacenarlo, puedes compartirlo en rede sociales.</p>
  <div class="virtual-ticket">
    <div class="ticket ticket--<?php echo (strtolower($registration->pack->name) === 'gratis') ? 'free' : $registration->pack->name ; ?> ticket--access">
      <div class="ticket__content">
        <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
        <p class="ticket__plan"><?php echo strtolower($registration->pack->name); ?></p>
        <p class="ticket__name"><?php echo $registration->user->name . ' ' . $registration->user->lastname; ?></p>
      </div>
      <p class="ticket__code">
        <?php echo '#' . $registration->token; ?>
      </p>
    </div>
  </div>
</main>