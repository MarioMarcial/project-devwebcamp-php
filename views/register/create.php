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
          purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":199}}]
        });
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          
          const data = new FormData();
          data.append('pack_id', orderData.purchase_units[0].description);
          data.append('payment_id', orderData.purchase_units[0].payments.captures[0].id);

          fetch('/finalizar-registro/pagar', {
            method: 'POST',
            body: data
          })
          .then(response => response.json())
          .then(result => {
            if(result.result) {
              actions.redirect('http://localhost:3000/finalizar-registro/conferencias');
            }
          })
        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
</script>