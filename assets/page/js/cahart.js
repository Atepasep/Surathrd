$(document).ready(function(){
	// var data1 = [];
	// $.ajax({
	// 	url : "gou/get_data",
	// 	method:"POST",
	// 	data : {},
	// 	dataType : "json",
	// 	success : function(datae){
	// 		for(x=0;x<=datae.length-1;x++){
	// 			data1.push(datae[x]['currmonth']/10000000);
	// 		}
	// 		var akme =data1;
	// 	}
	// });
	//alert(data1);
	var cek = <?php echo json_encode($tes1); ?>
	alert(cek);
	var areaChartData = {
      labels  : ['DL', 'PE', 'FE', 'EL', 'MF', 'FS', 'RP', 'SP', 'OS', 'WS'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [12,12,12,12,12,12,12,12,12]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [12,12,12,12,12,12,12,12,12]
        }
      ]
    }

  //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas);
    var barChartData                     = areaChartData;
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = true
    barChart.Bar(barChartData, barChartOptions);
//}
});

function isidata1(){
	var dataz = [];
	$.ajax({
		url : "gou/get_data",
		method:"POST",
		data : {},
		dataType : "json",
		success : function(datae){
			for(x=0;x<=datae.length-1;x++){
				dataz.push(datae[x]['currmonth']/10000000);
			}
		}
	});
	//alert(data1);
	return dataz;
}