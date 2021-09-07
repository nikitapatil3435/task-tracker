<?php
	//require ('/db.php' );
function get_data($Cols, $Table) {	
	include 'db.php';
	mysqli_query ($con,"set character_set_results='utf8'");   
	$select=mysqli_query($con,"select " . $Cols . " from " . $Table);
	//print_r ($select);
	//echo "Select ".$Cols ." from ".$Table;
	if(mysqli_num_rows($select) > 0){
		return $select;
	}else{
		return null;
	}
       mysqli_close($con);
}	

function execute_query_and_retunvalue($column, $table_name_where_condition, $return_val) {
  include 'db.php';
  $query = "Select " . $column . " From " . $table_name_where_condition;
  mysqli_query($con, "set character_set_results='utf8'");
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row[$return_val];
  }
  mysqli_close($con);
}
		
?>