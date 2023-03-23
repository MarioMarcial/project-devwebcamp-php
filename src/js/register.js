import Swal from 'sweetalert2';
(function(){

  let events = [];  
  const summaryContainer = document.querySelector("#register-summary");

  if(summaryContainer) {
    // Form
    const registerForm = document.querySelector("#register");
    registerForm.addEventListener("submit", submitForm);

    // Events buttons
    const eventsButton = document.querySelectorAll(".event__add");
    eventsButton.forEach(button => {
      button.addEventListener('click', selectEvent);
    });

    showEvents();

    function selectEvent(e) {
      if(events.length < 5) {
        // Deactivate repeated events
        e.target.disabled = true;
        e.target.removeEventListener('click', selectEvent);
        // Add the selected events to the events array
        events = [... events, {
          id: e.target.dataset.id,
          name: e.target.parentElement.querySelector('.event__name').textContent.trim()
        }];
        showEvents();
      } else {
        Swal.fire({
          title: 'Error',
          text: 'Máximo 5 eventos por registro', 
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    }

    function showEvents() {
      // Clean event
      cleanEvent();
      if(events.length > 0) {
        events.forEach(event => {
          const domEvent = document.createElement("DIV");
          domEvent.classList.add("register__event");
          
          const eventName = document.createElement("H3");
          eventName.classList.add("register__name");
          eventName.textContent = event.name;

          // Delete button
          const deleteButton = document.createElement("BUTTON");
          deleteButton.classList.add("register__delete");
          deleteButton.innerHTML = `<i class="fa-solid fa-trash"></i>`;
          deleteButton.onclick = function() {
            deleteEvent(event.id);
          };

          // HTML render
          domEvent.appendChild(eventName);
          domEvent.appendChild(deleteButton);
          summaryContainer.appendChild(domEvent);
        })
      } else {
        const noRegister = document.createElement("P");
        noRegister.textContent = "No hay eventos, añade hasta 5 del lado izquierdo";
        noRegister.classList.add("register__text");
        summaryContainer.appendChild(noRegister);
      }
    }

    function deleteEvent(id) {
      events = events.filter(event => event.id !== id);
      const addButton = document.querySelector(`[data-id="${id}"]`);
      addButton.disabled = false;
      addButton.addEventListener("click", selectEvent);
      showEvents();
    }

    // Bring the current arrangement
    function cleanEvent() {
      while(summaryContainer.firstChild) {
        summaryContainer.removeChild(summaryContainer.firstChild);
      }
    }

    async function submitForm(e) {
      e.preventDefault();

      // Get gift
      const giftId = document.querySelector("#gift").value;

      // Get id of each event
      const eventsId = events.map(event => event.id);

      if(events.length === 0 || giftId === "") {
        Swal.fire({
          title: 'Error',
          text: 'Elige al menos un Evento y un Regalo', 
          icon: 'error',
          confirmButtonText: 'OK'
        });
        return;
      }

      // FormData
      const data = new FormData();
      data.append('events', eventsId);
      data.append('gift_id', giftId);

      // Fetch
      const url = '/finalizar-registro/conferencias';
      const response = await fetch(url, {
        method: 'POST',
        body: data
      });
      const result = await response.json();
      console.log(result);
    }
  }
})();