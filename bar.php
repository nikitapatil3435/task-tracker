<?php
        include 'header.php';
        require "dal/load_data.php";
       
        ?>
		<?php
$menu = 'Task Bar';
include 'menu.php';
?>
<?php
    if (isset($_SESSION["task_bar_id"]) && $_SESSION["task_bar_id"] != ''){
    $get_today_tasks= get_data("*","vw_task where date(due_date)='".date("Y-m-d")."' and is_complete=0 and qut_id='".$_SESSION['task_bar_id']."'");
         if(isset($get_today_tasks)){
         $count_todays = mysqli_num_rows($get_today_tasks);}else{$count_todays=0;}
		$get_pendind_task=get_data("*","vw_task where date(due_date)<'".date("Y-m-d")."' and is_complete=0 and qut_id='".$_SESSION['task_bar_id']."'");
         if(isset($get_pendind_task)){
         $count_pending=mysqli_num_rows($get_pendind_task);}else{$count_pending=0;}	 
		$get_upcomming_task=get_data("*","vw_task where date(due_date)>'".date("Y-m-d")."' and is_complete=0 and qut_id='".$_SESSION['task_bar_id']."'");
         if(isset($get_upcomming_task)){
         $count_upcomming=mysqli_num_rows($get_upcomming_task);}else{$count_upcomming=0;}	
		 $get_recent_task=get_data("*","vw_task where is_complete=1 and qut_id='".$_SESSION['task_bar_id']."'");
         if(isset($get_recent_task)){
         $count_recent=mysqli_num_rows($get_recent_task);}	else{$count_recent=0;}
	}
    $dataPoints = array(
	array("label"=> "Todays Task", "y"=>  "$count_todays"),
	array("label"=> "Pending Task", "y"=> "$count_pending"),
	array("label"=> "Upcomming Task", "y"=> "$count_upcomming"),
	array("label"=> "Recent Task", "y"=> "$count_recent"),
	
);
	
?>
<!DOCTYPE HTML>
<html>
<head>  

		<script src="jquery/dashboard.js" type="text/javascript"></script>
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Task Bar"
	},
	subtitles: [{
		text: "Task details of project"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<br>
<br>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>    