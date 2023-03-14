(function() {
  const hours = document.querySelector('#hours');
  
  if(hours) {
    let search = {
      category_id: '',
      day: ''
    };

    const category = document.querySelector('[name=category_id]');
    const days = document.querySelectorAll('[name=day]');
    const inputHiddenDay = document.querySelector('[name=day_id]');
    category.addEventListener('change', endSearch);
    days.forEach(day => {
      day.addEventListener('change', endSearch);
    });

    function endSearch(e) {
      search[e.target.name] = e.target.value;
      console.log(search);
    }
  }
})();