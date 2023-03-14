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
      const url = `/api/eventos-horario?day_id=${day_id}&category_day=${category_id}`;
      console.log(url);
      const result = await fetch(url);
      const events = await result.json();
      
      getAvailableHours();
    }

    function getAvailableHours() {
      
    }
  }
})();