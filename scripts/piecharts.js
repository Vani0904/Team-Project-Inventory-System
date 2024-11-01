let ctx = document.getElementById('pieChartFull').getContext('2d');
let ctx2 = document.getElementById('pieChartBranch').getContext('2d');
let labels = ['Product A', 'Product B', 'Product C', 'Product D'];
let colorHex = ['#876FD4', '#4394E5', '#87BB62', '#F5921B'];

const pieChartFull = new Chart(ctx,
  {
    type: 'pie',
    data:
    {
      datasets:
        [{
          data: [100, 50, 75, 120],
          backgroundColor: colorHex
        }],
      labels: labels
    },
    options:
    {
      responsive: true,
      legend:
      {
        position: 'left'
      },
      plugins:
      {
        datalabels:
        {
          color: '#fff',
          anchor: 'end',
          align: 'start',
          offset: -10,
          borderWidth: 2,
          borderColor: '#fff',
          borderRadius: 25,
          backgroundColor: (context) => {
            return context.dataset.backgroundColor;
          },
          font:
          {
            weight: 'bold',
            size: '10'
          },
          formatter: (value) => {
            return value + ' %';
          }
        }
      }
    }
  })

const pieChartBranch = new Chart(ctx2,
  {
    type: 'pie',
    data:
    {
      datasets:
        [{
          data: [15, 25, 35, 80],
          backgroundColor: colorHex
        }],
      labels: labels
    },
    options:
    {
      responsive: true,
      legend:
      {
        position: 'right'
      },
      plugins:
      {
        datalabels:
        {
          color: '#fff',
          anchor: 'end',
          align: 'start',
          offset: -10,
          borderWidth: 2,
          borderColor: '#fff',
          borderRadius: 25,
          backgroundColor: (context) => {
            return context.dataset.backgroundColor;
          },
          font:
          {
            weight: 'bold',
            size: '10'
          },
          formatter: (value) => {
            return value + ' %';
          }
        }
      }
    }
  })