(function() {
  const inputSpeakers = document.querySelector('#speakers');
  if(inputSpeakers) {
    let speakers = [];
    let filterSpeakers = [];

    getSpeakers();

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
      console.log(speakers);
    }
  }
})();