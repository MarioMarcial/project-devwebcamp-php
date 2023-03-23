import Swal from 'sweetalert2';
(function(){

  let events = [];  
  const summaryContainer = document.querySelector("#register-summary");
  const eventsButton = document.querySelectorAll(".event__add");
  eventsButton.forEach(button => {
    button.addEventListener('click', selectEvent);
  });

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

})();