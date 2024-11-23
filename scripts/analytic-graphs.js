function loadData(all, branch) 
{
  const productNamesAll = all.map(item => item.name);
  const quantitiesAll = all.map(item => item.quantity);
  const productNamesBranch = branch.map(item => item.name);
  const quantitiesBranch = branch.map(item => item.quantity);

  let ctx = document.getElementById('pieChartFull').getContext('2d');
  let ctx2 = document.getElementById('pieChartBranch').getContext('2d');

  const pieChartFull = new Chart(ctx,
    {
      type: 'bar',
      data:
      {
        labels: productNamesAll,
        datasets:
          [{
            data: quantitiesAll,
            backgroundColor: '#bb90db',
            hoverBackgroundColor: '#7b38ad',
            borderColor: '#000000',
            borderWidth: 0,
          }]
      },
      options:
      {
        indexAxis: 'y',
        scales:
        {
          x:
          {
            title:
            {
              display: true,
              text: 'Quantity'
            },
            ticks:
            {
              autoSkip: false,
              maxRotation: 0,
              minRotation: 0
            }
          },
          y:
          {
            title:
            {
              display: true,
              text: 'Product'
            },
            ticks:
            {
              autoSkip: false,
            },
            beginAtZero: true
          }
        },
        responsive: true,
        plugins:
        {
          legend:
          {
            display: false,
          }
        }
      },
    });

  const pieChartBranch = new Chart(ctx2,
    {
      type: 'bar',
      data:
      {
        labels: productNamesBranch,
        datasets:
          [{
            data: quantitiesBranch,
            backgroundColor: '#bb90db',
            hoverBackgroundColor: '#7b38ad',
            borderColor: '#000000',
            borderWidth: 0,
          }]
      },
      options:
      {
        indexAxis: 'y',
        scales:
        {
          x:
          {
            title:
            {
              display: true,
              text: 'Quantity'
            },
            ticks:
            {
              autoSkip: false,
            }
          },
          y:
          {
            title:
            {
              display: true,
              text: 'Product'
            },
            ticks:
            {
              autoSkip: false,
              maxRotation: 0,
              minRotation: 0
            },
            beginAtZero: true
          }
        },
        responsive: true,
        plugins:
        {
          legend:
          {
            display: false,
          }
        }
      },
    });
}

