(function() {
  const inputSpeakers = document.querySelector('#speakers');
  if(inputSpeakers) {
    let speakers = [];
    let filteredSpeakers = [];

    const speakersList = document.querySelector('#speakers-list');
    const hiddenSpeaker = document.querySelector('[name="speaker_id"]');

    getSpeakers();
    inputSpeakers.addEventListener('input', searchSpeakers);

    if(hiddenSpeaker.value) {
      (async() => {
        const speaker = await getSpeaker(hiddenSpeaker.value);
        // Add to the HTML
        const speakerDOM = document.createElement("LI");
        speakerDOM.classList.add("speakers-list__speaker", "speakers-list__speaker--selected");
        speakerDOM.textContent = `${speaker.name} ${speaker.lastname}`;
        speakersList.appendChild(speakerDOM);
        
      })()
    }

    async function getSpeakers() {
      const url = `/api/ponentes`;
      const response = await fetch(url);
      const result = await response.json();
      speakersFormat(result);
    }

    async function getSpeaker(id) {
      const url = `/api/ponente?id=${id}`;
      const response = await fetch(url);
      const result = await response.json();
      return result;
    }

    function speakersFormat(arraySpeakers = []) {
      speakers = arraySpeakers.map(speaker => {
        return {
          name: `${speaker.name.trim()} ${speaker.lastname.trim()}`,
          id: speaker.id
        }
      })
    }

    function searchSpeakers(e) {
      const searching = e.target.value;
      if(searching.length > 3) {
        const expression = new RegExp(searching, "i");
        filteredSpeakers = speakers.filter(speaker => {
          if(speaker.name.toLowerCase().search(expression) != -1) {
            return speaker;
          }
        })
      } else {
        filteredSpeakers = [];
      }
      showSpeakers();
    }

    function showSpeakers() {
      while(speakersList.firstChild) {
        speakersList.removeChild(speakersList.firstChild);
      }

      if(filteredSpeakers.length > 0) {
        filteredSpeakers.forEach(speaker => {
          const htmlSpeaker = document.createElement("LI");
          htmlSpeaker.classList.add("speakers-list__speaker");
          htmlSpeaker.textContent = speaker.name;
          htmlSpeaker.dataset.speakerId = speaker.id;
          htmlSpeaker.onclick = selectSpeaker;
          // Add to DOM
          speakersList.appendChild(htmlSpeaker);
        })
      } else {
        const noResults = document.createElement("P");
        noResults.classList.add("speakers-list__no-result");
        noResults.textContent = 'No hay resultados para tu búsqueda';
        speakersList.appendChild(noResults);
      }
    }

    function selectSpeaker(e) {     
      const speaker = e.target;

      const prevSpeaker = document.querySelector('.speakers-list__speaker--selected');
      if(prevSpeaker) {
        prevSpeaker.classList.remove('speakers-list__speaker--selected');
      }

      speaker.classList.add('speakers-list__speaker--selected');
      hiddenSpeaker.value = speaker.dataset.speakerId;
    }
  }
})();