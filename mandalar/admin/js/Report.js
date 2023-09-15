const ctx = document.getElementById("BarChart");
const ctx2 = document.getElementById("PieChart");
const subCategoryChart = document.getElementById("SubChart2");
const subCategoryPieChart = document.getElementById("PieChart2");
const lineChart = document.getElementById("LineChart");
const lineChart2 = document.getElementById("LineChart2");


function createBarChart(ctx, label, dataList) {
	let data = dataList[0];
	let data2 = dataList[1];
	new Chart(ctx, {
		type: "bar",
		data: {
			labels: label,
			datasets: [
				{
					label: "total",
					data: data,
					borderWidth: 1,
				},
				{
					label: "sold out",
					data: data2,
					borderWidth: 1,
				},
			],
		},
		options: {
			scales: {
				y: {
					beginAtZero: true,
				},
			},
		},
	});
}

function createLineChart(ctx, label, dataList,label2) {
	
	new Chart(ctx, {
		type: "line",
		data: {
			labels: label,
			datasets: [
				{
					label: label2,
					data: dataList,
					borderWidth: 1,
				},
			
			],
		},
		options: {
			scales: {
				y: {
					beginAtZero: true,
				},
			},
		},
	});
}


function createPieChart(ctx, dataset) {
    console.log(dataset)
    let label = dataset['name'];
    let data = dataset['data'];
	new Chart(ctx, {
		type: "polarArea",
		data: {
			labels: label,
			datasets: [
				{
					label: "total",
					data: data,
					borderWidth: 1,
				},
			],
		},
		options: {
			scales: {
				y: {
					beginAtZero: true,
				},
			},
		},
	});
}

// Function to fetch data and create the bar chart
function fetchAndCreateBarChart(ctx,type) {
    fetchData(type[0])
      .then(function (result1) {
        let data1 = result1["data"];
        let label1 = result1["name"];
        return fetchData(type[1]).then(function (result2) {
          let data2 = result2["data"];
          createBarChart(ctx, label1, [data1, data2]);
        });
      })
      .catch(function (error) {
        console.error(error);
      });
  }

  function fetchAndCreateLineChart(ctx,type,label) {
    fetchData(type)
      .then(function (result1) {
        let data1 = result1["data"];
        let label1 = result1["name"];
		createLineChart(ctx,label1,data1,label);
      
      })
      .catch(function (error) {
        console.error(error);
      });
  }
  
  // Call fetchAndCreateBarChart to fetch data and create the bar chart
  fetchAndCreateBarChart(ctx,['total_by_cat','sold_out_total_by_cat']);
  fetchAndCreateBarChart(subCategoryChart,["total_by_sub_cat","sold_out_total_by_sub_cat"]);
//   fetchAndCreateLineChart(lineChart,"post_by_each_day","Total");
  fetchAndCreateLineChart(lineChart2,"sold_out_post_by_each_day","sold out");

  

function fetchData(type) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        url: "php/getReport.php",
        type: "GET",
        data: { type: type },
        success: function (dataList) {
          console.log("respove",dataList);
          let result = JSON.parse(dataList);
          console.log("Fetch Data",result);
          resolve(result);
        },
        error: function (error) {
          reject(error);
        },
      });
    });
  }
  


function fetchDataAndCreateChart(type, ctx) {
    fetchData(type)
        .then(function (result) {
            createPieChart(ctx, result);
        })
        .catch(function (error) {
            console.error(error);
        });
}

fetchDataAndCreateChart("sold_out_total_by_cat", ctx2);
fetchDataAndCreateChart("sold_out_total_by_sub_cat", subCategoryPieChart);

//Toal Posts By Each Sub Category With Bar Ca

function openTab(tabName) {
    // Hide all tab content and deactivate all tab buttons
    const tabContents = document.querySelectorAll(".tab-content");
    const tabButtons = document.querySelectorAll(".tab-button");

    for (const content of tabContents) {
        content.classList.remove("active");
    }

    for (const button of tabButtons) {
        button.classList.remove("active1");
    }

    // Show the selected tab content and activate the corresponding tab button
    document.getElementById(tabName).classList.add("active");
    document.querySelector(`.tab-button[data-tab="${tabName}"]`).classList.add("active1");
}

// Initialize the first tab as active
openTab('tab1');
