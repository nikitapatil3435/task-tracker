<?php
session_start();
include 'db.php';
include 'load_data.php';
if(isset($_POST['load_state'])){
	//echo "select module_name from tbl_quatation_pert where qut_id='".$_POST['project_name']."'";
	$state = get_data("*","tbl_state where country_id='".$_POST['country_name']."'");
	if(isset($state)){
		while($row=mysqli_fetch_array($state)){
			echo "<option value='".$row['state_id']."' data-id='".$row['state_name']."'>".$row['state_name']."</option>";	
		}
	}
	
}
if(isset($_POST['load_city'])){
	//echo "select module_name from tbl_quatation_pert where qut_id='".$_POST['project_name']."'";
	$state = get_data("*","tbl_city where state_id='".$_POST['state_name']."'");
	if(isset($state)){
		while($row=mysqli_fetch_array($state)){
			echo "<option value='".$row['city_id']."' data-id='".$row['city_name']."'>".$row['city_name']."</option>";	
		}
	}
	
}
?>