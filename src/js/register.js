(function(){

  let events = [];  
  const eventsButton = document.querySelectorAll('.event__add');
  eventsButton.forEach(button => {
    button.addEventListener('click', selectEvent);
  });

  function selectEvent(e) {
    // Deactivate repeated events
    e.target.disabled = true;
    e.target.removeEventListener('click', selectEvent);
    // Add the selected events to the events array
    events = [... events, {
      id: e.target.dataset.id,
      name: e.target.parentElement.querySelector('.event__name').textContent.trim()
    }];
    console.log(events);
  }

})();