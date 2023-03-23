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
      <div id="smart-button-container">
        <div style="text-align: center;">
          <div id="paypal-button-container"></div>
        </div>
      </div>
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

<script src="https://www.paypal.com/sdk/js?client-id=AS7ib_TzY0wVQ9z163K6qap28se-j5hMTV-6sZnvg6oWufkfsT0n3EFGA_2Cq9HbckTI9wHsKLLm4B17&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
  function initPayPalButton() {
    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'blue',
        layout: 'vertical',
        label: 'pay',
        
      },

      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{"description":"Pago Presencial DevWebCamp","amount":{"currency_code":"USD","value":199}}]
        });
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          
          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Thank you for your payment!</h3>';

          // Or go to another URL:  actions.redirect('thank_you.html');
          
        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
</script>