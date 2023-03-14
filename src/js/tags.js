(function() {
  const tagsInput = document.querySelector('#tags_input');
  if(tagsInput) {

    const tagsDiv = document.querySelector('#tags');
    const tagsInputHidden = document.querySelector('[name="tags"]');

    let tags = [];

    // Get tags from hidden input
    if(tagsInputHidden.value !== '') {
      tags = tagsInputHidden.value.split(',');
      showTags();
    }

    // Listening to changes in the input
    tagsInput.addEventListener('keypress', saveTag);

    function saveTag(e) {
      if(e.keyCode === 44) {
        e.preventDefault();
        const regexp = /^([A-Za-z0-9\u002e\u002b\u0023\u0020]){2,15}$/i;
        if(!regexp.exec(e.target.value.trim())) {
          tagsInput.value = '';
          return;
        } 
        if (tags.includes(e.target.value.toLowerCase())) {
          tagsInput.value = '';
          return;
        }
        
        tags = [...tags, e.target.value.toLowerCase().trim()];
        tagsInput.value = '';
        showTags();
      }
    }

    function showTags() {
      tagsDiv.textContent = '';
      tags.forEach(tag => {
        const tagElement = document.createElement('LI');
        tagElement.classList.add('form__tag');
        tagElement.textContent = tag[0].toUpperCase() + tag.substring(1);
        tagElement.ondblclick = deleteTag;
        tagsDiv.appendChild(tagElement);
      })
      updateInputHidden();
    }
    
    function deleteTag(e) {
      e.target.remove();
      tags = tags.filter(tag => tag !== e.target.textContent.toLowerCase());
      updateInputHidden();
    }

    function updateInputHidden() {
      tagsInputHidden.value = tags.toString();
    }

  }
})();
