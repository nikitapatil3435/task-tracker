<?php
 require "dal/load_data.php";
 require "dal/db.php";
  $get_chart_data= get_data("year,year19","tbl_barchart");
  $dataPoints = array();
  if(isset($get_chart_data)){  
      while($row=mysqli_fetch_array($get_chart_data)){
		  Array_push($dataPoints, array('y'=>$row['year19'], 'label'=>$row['year']));
	  }
  }
 //var_dump($dataPoints);
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "2019"
	},
	axisY: {
		title: "newly reliance jio subscribers"
	},
	
	data: [{
		 color: "#6495ED",  
		type: "column",
		indexLabel: "{y}",
		indexLabelPlacement: "outside",
		yValueFormatString: "##0K",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>          