


window.document.onload = function (e) {

};
var myChart = null;
class graphElement extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.shadowRoot.innerHTML = document.querySelector('#tmpGraph').innerHTML;
    let canvas1 = document.getElementById('graph').shadowRoot.querySelector('#myChart');let transType = ['Expense', 'Income'];
    fetchYearlyData('CREDIT');
    fetchYearlyData('DEBIT');
    this.drawChart(transType,'#myChart');

this.shadowRoot.querySelector('#refresh').addEventListener("click", async  (e)=> {
            labels=[],dataDB=[],dataCRD=[];
            await Promise.all([
                myChart.destroy(),
               fetchYearlyData('CREDIT'),
               fetchYearlyData('DEBIT'),
               this.drawChart(transType,'#myChart')
            ]);
        });
        
        
this.shadowRoot.querySelector('#item').addEventListener("click", async  (e)=> {
           
            labels=[],dataDB=[],dataCRD=[];
            await Promise.all([
                myChart.destroy(),
               fetchYearlyDataItem(),
               this.drawChart(transType,'#myChartInven')
            ]);
        });
  }
  drawChart(transType) {
    var ctx = document.getElementById('graph').shadowRoot.querySelector('#myChart').getContext('2d');
    myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: transType[0],
          borderColor: "#f48480",
          pointBorderColor: "#f48480",
          pointBackgroundColor: "#f48480",
          pointHoverBackgroundColor: "#f48480",
          pointHoverBorderColor: "#f48480",
          pointBorderWidth: 10,
          pointHoverRadius: 10,
          pointHoverBorderWidth: 1,
          pointRadius: 3,
          fill: false,
          borderWidth: 4,
          data: dataDB
        },
        {
          label: transType[1],
          borderColor: "#80b6f4",
          pointBorderColor: "#80b6f4",
          pointBackgroundColor: "#80b6f4",
          pointHoverBackgroundColor: "#80b6f4",
          pointHoverBorderColor: "#80b6f4",
          pointBorderWidth: 10,
          pointHoverRadius: 10,
          pointHoverBorderWidth: 1,
          pointRadius: 3,
          fill: false,
          borderWidth: 4,
          data: dataCRD
        }],
      },
      options: {
        legend: {
          position: "top"
        },
        scales: {
          yAxes: [{
            ticks: {
              fontColor: "rgba(0,0,0,0.5)",
              fontStyle: "bold",
              beginAtZero: true,
              maxTicksLimit: 5,
              padding: 20
            },
            gridLines: {
              drawTicks: false,
              display: false
            }
          }],
          xAxes: [{
            gridLines: {
              zeroLineColor: "transparent"
            },
            ticks: {
              padding: 20,
              fontColor: "rgba(0,0,0,0.5)",
              fontStyle: "bold"
            }
          }]
        }
      }
    });
  }
  
   drawChartItem(transType) {
    var ctx = document.getElementById('graph').shadowRoot.querySelector('#myChart').getContext('2d');
    myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: transType[0],
          borderColor: "#f48480",
          pointBorderColor: "#f48480",
          pointBackgroundColor: "#f48480",
          pointHoverBackgroundColor: "#f48480",
          pointHoverBorderColor: "#f48480",
          pointBorderWidth: 10,
          pointHoverRadius: 10,
          pointHoverBorderWidth: 1,
          pointRadius: 3,
          fill: false,
          borderWidth: 4,
          data: dataDB
        },
        {
          label: transType[1],
          borderColor: "#80b6f4",
          pointBorderColor: "#80b6f4",
          pointBackgroundColor: "#80b6f4",
          pointHoverBackgroundColor: "#80b6f4",
          pointHoverBorderColor: "#80b6f4",
          pointBorderWidth: 10,
          pointHoverRadius: 10,
          pointHoverBorderWidth: 1,
          pointRadius: 3,
          fill: false,
          borderWidth: 4,
          data: dataCRD
        }],
      },
      options: {
        legend: {
          position: "top"
        },
        scales: {
          yAxes: [{
            ticks: {
              fontColor: "rgba(0,0,0,0.5)",
              fontStyle: "bold",
              beginAtZero: true,
              maxTicksLimit: 5,
              padding: 20
            },
            gridLines: {
              drawTicks: false,
              display: false
            }
          }],
          xAxes: [{
            gridLines: {
              zeroLineColor: "transparent"
            },
            ticks: {
              padding: 20,
              fontColor: "rgba(0,0,0,0.5)",
              fontStyle: "bold"
            }
          }]
        }
      }
    });
  }
}
let dataDB = [], dataCRD = [], labels = [], local =[];


function fetchYearlyDataItem(transType) {
  let dataArr = [];
  let query = `
select item_name,
       sum(case when debit = 1 then balance else 0 end) as loss,
       sum(case when credit = 1 then balance else 0 end) as profit
from \`${db}_ledger\`
group by item_name;`;
  var xhhtp = new XMLHttpRequest();
  xhhtp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      local = JSON.parse(this.responseText);
     for (let i = 0 ; i <  local.length ; i++) {
          labels.push(local[i].item_name);
       dataDB[i] = local[i].loss;
        dataCRD[i] = local[i].profit;
         
     }
          
    }
  }
  xhhtp.withCredentials = true;
  xhhtp.open('POST', 'database/fetchYearlyInven.php', false);
  xhhtp.send(query);

}



function fetchYearlyData(transType) {
  let dataArr = [];
  let query = `SELECT MONTHNAME(logdate) as Month, SUM(balance) as SUM
FROM \`${db}_ledger\` WHERE ${transType} =1
GROUP BY YEAR(logdate), MONTH(logdate);`;
  var xhhtp = new XMLHttpRequest();
  xhhtp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      local = JSON.parse(this.responseText);
      for (let r of local) {
        if (!labels.includes(r.MONTH))
          labels.push(r.MONTH);

        if (transType == 'DEBIT') { dataDB.push(r.SUM); }
        else { dataCRD.push(r.SUM) }

      }
    }
  }
  xhhtp.withCredentials = true;
  xhhtp.open('POST', 'database/fetchYearly.php', false);
  xhhtp.send(query);

}

window.customElements.define('bbl-graphs', graphElement);