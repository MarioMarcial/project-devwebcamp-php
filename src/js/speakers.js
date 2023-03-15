(function() {
  const inputSpeakers = document.querySelector('#speakers');
  if(inputSpeakers) {
    let speakers = [];
    let filteredSpeakers = [];

    getSpeakers();
    inputSpeakers.addEventListener('input', searchSpeakers);

    async function getSpeakers() {
      const url = `/api/ponentes`;
      const response = await fetch(url);
      const result = await response.json();
      speakersFormat(result);
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
        console.log(filteredSpeakers);
      }
    }
  }
})();