(function() {
  const tagsInput = document.querySelector('#tags_input');
  let tags = [];
  if(tagsInput) {
    // Listening to changes in the input
    tagsInput.addEventListener('keypress', saveTag);

    function saveTag(e) {
      if(e.keyCode === 44) {
        e.preventDefault();
        const regexp = /^([A-Za-z0-9\u002e\u002b\u0023]){2,15}$/i;
        if(!regexp.exec(e.target.value.trim())) {
          tagsInput.value = '';
          return;
        }
        tags = [...tags, e.target.value.trim()];
        tagsInput.value = '';
        console.log(tags);
      }
    }
  }
})()
