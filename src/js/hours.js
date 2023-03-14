(function() {
  const hours = document.querySelector('#hours');
  
  if(hours) {
    let search = {
      category_id: '',
      day_id: ''
    };

    const category = document.querySelector('[name=category_id]');
    const days = document.querySelectorAll('[name=day_id]');
    const inputHiddenDay = document.querySelector('[name=day_id]');
    const inputHiddenHour = document.querySelector('[name=hour_id]');
    category.addEventListener('change', endSearch);
    days.forEach(day => {
      day.addEventListener('change', endSearch);
    });

    function endSearch(e) {
      search[e.target.name] = e.target.value;
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
      // Check assigned events and remove the disabled class
      const assignedHours = events.map(event => event.hour_id);
      const hoursList = document.querySelectorAll('#hours li');
      
      const availableHours = document.querySelectorAll('#hours li');
      availableHours.forEach(hour => {
        hour.addEventListener('click', selectHour);
      });
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
    }
  }
})();