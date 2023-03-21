  <main class="register">
    <h2 class="register__heading"><?php echo $title ?></h2>
    <p class="register__description">Elige tu plan</p>
    <div class="packs__grid">
      <div class="pack">
        <h3 class="pack__name">Pase Gratis</h3>
        <ul class="pack__list">
          <li class="pack__list-item">Acceso Virtual a DevWebCamp</li>
        </ul>
        <p class="pack__price">$0</p>
        <form action="/finalizar-registro/gratis" method="post">
          <input type="submit" class="packs__submit" value="Inscripción Gratis">
        </form>
      </div>
      <div class="pack">
        <h3 class="pack__name">Pase Presencial</h3>
        <ul class="pack__list">
          <li class="pack__list-item">Acceso Presencial a DevWebCamp</li>
          <li class="pack__list-item">Pase por 2 días</li>
          <li class="pack__list-item">Acceso a Talleres y Conferencias</li>
          <li class="pack__list-item">Acceso a las Grabaciones</li>
          <li class="pack__list-item">Camisa del Evento</li>
          <li class="pack__list-item">Comida y Bebida</li>
        </ul>
        <p class="pack__price">$199</p>
      </div>
      <div class="pack">
        <h3 class="pack__name">Pase Virtual</h3>
        <ul class="pack__list">
          <li class="pack__list-item">Acceso Virtual a DevWebCamp</li>
          <li class="pack__list-item">Pase por 2 días</li>
          <li class="pack__list-item">Enlace a Talleres y Conferencias</li>
          <li class="pack__list-item">Acceso a las Grabaciones</li>
        </ul>
        <p class="pack__price">$49</p>
      </div>
    </div>
  </main>