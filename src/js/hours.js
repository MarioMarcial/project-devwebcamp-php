(function() {
  const hours = document.querySelector('#hours');
  
  if(hours) {
    
    const category = document.querySelector('[name=category_id]');
    const days = document.querySelectorAll('[name=day_id]');
    const inputHiddenDay = document.querySelector('[name=day]');
    const inputHiddenHour = document.querySelector('[name=hour_id]');

    category.addEventListener('change', searchTerms);
    days.forEach(day => {
      day.addEventListener('change', searchTerms);
    });
    
    let search = {
      category_id: +category.value || '',
      day_id: +inputHiddenDay.value || ''
    };

    if(!Object.values(search).includes('')) {
      async function startApp() {
        await searchEvents();

        // Add selected class to the current time
        const id = inputHiddenHour.value;
        const selectedHour = document.querySelector(`[data-hour-id="${id}"]`);
        selectedHour.classList.remove('hours__hour--disabled');
        selectedHour.classList.add('hours__hour--selected');
        selectedHour.onclick = selectHour;
      }

      startApp();
    }

    function searchTerms(e) {
      search[e.target.name] = e.target.value;

      // Reset hidden fields & hour selector
      inputHiddenHour.value = '';
      inputHiddenDay.value = '';

      // Deactive prev hour, if there is a new click
      const prevHour = document.querySelector('.hours__hour--selected');
      if(prevHour) {
        prevHour.classList.remove('hours__hour--selected');
      }

      if(Object.values(search).includes('')) {
        return ;
      }
      searchEvents();
    }

    async function searchEvents(){
      // Get ids
      const { day_id, category_id } = search;
      const url = `/api/eventos-horario?day_id=${day_id}&category_id=${category_id}`;
      const result = await fetch(url);
      const events = await result.json();
      getAvailableHours(events);
    }

    function getAvailableHours(events) {
      // Reset hours
      const hoursList = document.querySelectorAll('#hours li');
      hoursList.forEach(li => li.classList.add('hours__hour--disabled'));

      // Check assigned events
      const assignedHours = events.map(event => event.hour_id);
      
      const hoursListArray = Array.from(hoursList);

      // Get unassigned hours
      const unassignedHours = hoursListArray.filter(li => !assignedHours.includes(li.dataset.hourId));

      // Remove the disabled class from the unassigned hours
      unassignedHours.forEach(li => li.classList.remove('hours__hour--disabled'));

      const availableHours = document.querySelectorAll('#hours li:not(.hours__hour--disabled)');
      availableHours.forEach(hour => {
        hour.addEventListener('click', selectHour);
      });

      const disabledHours = document.querySelectorAll('.hours__hour--disabled');
      disabledHours.forEach(hour => hour.removeEventListener('click', selectHour));
    }

    function selectHour(e) {
      // Deactive prev hour, if there is a new click
      const prevHour = document.querySelector('.hours__hour--selected');
      if(prevHour) {
        prevHour.classList.remove('hours__hour--selected');
      }
      // Add selected class
      e.target.classList.add('hours__hour--selected');
      inputHiddenHour.value = e.target.dataset.hourId;

      // Fill day input hidden
      inputHiddenDay.value = document.querySelector('[name="day_id"]:checked').value;
    }
  }
})();