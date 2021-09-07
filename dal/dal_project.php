<?php
session_start();
include 'db.php';
include 'load_data.php';
/*$is_allowed = 0;
$insert = 0;
$edit = 0;
$delete = 0;
$print = 0;
$approve = 0;
$rights = get_data("is_allowed,`insert`,`edit`,`delete`,`print`,`approve`", "vw_rolewiserights where menu='Project' and role_id=" . $_SESSION['role_id']);
if (isset($rights)) {
  while ($row = mysqli_fetch_array($rights)) {
    $is_allowed = $row['is_allowed'];
    $insert = $row['insert'];
    $edit = $row['edit'];
    $delete = $row['delete'];
    $print = $row['print'];
    $approve = $row['approve'];
  }
}*/

if(isset($_POST['get_save'])) {
	$adduserdate = date('Y-m-d h:m:s');
	if($_POST['p_startdate']==""){
		$_POST['p_startdate']="1900-01-01";
	}
	if($_POST['p_enddate']==""){
		$_POST['p_enddate']="1900-01-01";
	}
	if($_POST['amc_date']==""){
		$_POST['amc_date']="1900-01-01";
	}
	mysqli_query($con, "set @id = " . $_POST['p_id']);
	echo "call project(@id,'$_POST[p_name]','$_POST[p_description]','$_POST[p_startdate]','$_POST[p_enddate]','$_POST[p_kilometer]','$_POST[p_cost]','$_POST[amc_amount]','$_POST[amc_date]','$_SESSION[user_id]','$adduserdate','$_POST[mode]')";
	$query = mysqli_query($con,"call project(@id,'$_POST[p_name]','$_POST[p_description]','$_POST[p_startdate]','$_POST[p_enddate]','$_POST[p_kilometer]','$_POST[p_cost]','$_POST[amc_amount]','$_POST[amc_date]','$_SESSION[user_id]','$adduserdate','$_POST[mode]')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
    echo $row['@id'];
	exit();
}

if(isset($_POST['fill_projectlist'])) {
	$projectdetails = get_data("*", "tbl_project where project_id!=0");
 $output = '<table id="tblprojectdetails" class="display" style="width:100%">
                 <thead>
				    <tr>
				     <th class="w3-hide"> id</th>
					  <th>Project Name</th>
				     <th>project Description</th>
					  <th>project Start Date</th>
                      <th>project End Date</th>
					  <th>Kilometer</th>
					  <th>project cost</th>
			          <th style="width:10%">Option</th>
				    </tr>
                </thead>
				<tbody>';
		if (isset($projectdetails)) {
 
      while ($r = mysqli_fetch_array($projectdetails)) {	
        $output = $output . '<tr>
                   <td class="w3-hide">' .$r["project_id"] .  '</td>
					<td data-label = "Project name">' . $r["project_name"] . '</td>
					<td data-label = "Description">' . $r["project_description"]. '</td>
					<td data-label = "Start Date">';
					if($r["project_start_date"]=="1970-01-01")
					{   
					    $output = $output .'';
					}else
					{
						$output = $output .date('d-m-Y', strtotime($r["project_start_date"])) ;
					}
					$output = $output . '</td>
				    <td data-label = "Completion date">';
				    if($r["project_complete_date"]=="1970-01-01")
					{   
					    $output = $output .'';
					}else
					{
						$output = $output .date('d-m-Y', strtotime($r["project_complete_date"])) ;
					}
					$output = $output . '</td>
					<td data-label = "Kilometer">' . $r["kilometer"]. '</td>
					<td data-label = "Project Cost">' . $r["project_cost"]. '</td>';
				
					
        $output = $output . '<td data-label = "Options">';				
		$output = $output . '<div class = "w3-right">';
		$output = $output . '<a class = "w3-text-blue" style="padding:5px" onclick ="edit_project('.$r["project_id"].')"><i class = "fa fa-edit"></i></a>';
		  
		 //echo "vw_report where project_id!=" .$r['project_id'];
		 $delete_data = get_data("*", "vw_report where project_id=" .$r['project_id']);//get all data from vw_report where project_id is present.
		 //check if any report is present for that project
		 if (isset($delete_data)){}//if(isset (record present then -{delete option not show})
	     else{
			 $output = $output . '<a class = "w3-text-red" style="padding:5px" onclick = "delete_project('.$r["project_id"].')"><i class = "fa fa-trash"></i></a>';
			 //if any record not  present for that project delete option show.
		 }
		 $output = $output . '</div></td></tr>';
      }
      $output = $output . '</tbody></table>';
    } 

  $_SESSION["search_table"] = "";
  echo $output;
}
if(isset($_POST['get_edit'])) {
    $_SESSION['pid'] = $_POST['p_id'];
    echo $_SESSION['pid'];
    exit();
}

if(isset($_POST['get_delete'])) 
{
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['p_id']);

	//echo "call project(@id,'$_POST[p_name]','$_POST[p_author]','$_POST[p_description]','$_POST[p_startdate]','$_POST[p_lastdate]','1','$adduserdate','3')";
	$query = mysqli_query($con,"call project(@id,'0','0','1990-01-01','1990-01-01','0','0','0','1990-01-01','1','$adduserdate','3')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
	 echo $row['@id'];
	exit();
}

if(isset($_POST['get_clear'])) {
    $_SESSION['pid'] = "";
 }

 if(isset($_POST['get_excel'])) {
    $_SESSION['p_fromdate'] = $_POST['from_date'];
	$_SESSION['p_todate'] = $_POST['To_date'];
	
	
   // echo $_SESSION['pid'];
    exit();
}

if(isset($_POST['search_employee'])) {
    $_SESSION['pid'] = "";
 }


?>