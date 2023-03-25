(function(){
  const graph = document.querySelector('#graph-gifts');
  if(graph) {
    getData();
    async function getData() {
      const url = '/api/regalos';
      const response = await fetch(url);
      const result = await response.json();

      const ctx = document.getElementById('graph-gifts');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: result.map(gift => gift.name),
          datasets: [{
            label: '',
            data: result.map(gift => gift.total),
            backgroundColor: [
              '#ea580c',
              '#84cc16',
              '#22d3ee',
              '#a855f7',
              '#ef4444',
              '#14b8a6',
              '#db2777',
              '#e11d48',
              '#7e22ce'
            ]
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          },
          plugins: {
            legend: {
              display: false
            }
          }
        }
      });
    }
  }
})();