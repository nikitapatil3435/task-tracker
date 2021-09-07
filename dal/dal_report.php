<?php
session_start();
include 'db.php';
include 'load_data.php';
$serverdate = date('m/d/y');
$today = date("Y-m-d", strtotime($serverdate));
$is_allowed = 0;
$insert = 0;
$edit = 0;
$delete = 0;
$print = 0;
$approve = 0;
$rights = get_data("is_allowed,`insert`,`edit`,`delete`,`print`,`approve`", "vw_rolewiserights where menu='Daily Task Report' and role_id=" . $_SESSION['role_id']);
if (isset($rights)) {
  while ($row = mysqli_fetch_array($rights)) {
    $is_allowed = $row['is_allowed'];
    $insert = $row['insert'];
    $edit = $row['edit'];
    $delete = $row['delete'];
    $print = $row['print'];
    $approve = $row['approve'];
  }
}
if(isset($_POST['report_save'])) 
{
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['report_id']);
	echo "call report(@id,'$_POST[reporting_date]','$_SESSION[user_id]','$_POST[task]','$_POST[project_name]','$_POST[module_name]','$_POST[form_name]','$_POST[start_time]','$_POST[end_time]','$_POST[task_status]','1','$adduserdate','$_POST[mode]')";
	$query = mysqli_query($con,"call report(@id,'$_POST[reporting_date]','$_SESSION[user_id]','$_POST[task]','$_POST[project_name]','$_POST[module_name]','$_POST[form_name]','$_POST[start_time]','$_POST[end_time]','$_POST[task_status]','1','$adduserdate','$_POST[mode]')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);	
    echo $row['@id'];
	$_SESSION['report_id'] = '';
	exit();
}
if(isset($_POST['fill_reportlist'])) {
	$custom_value = get_data("Value","tbl_customsetting where SID=1");
	if(isset($custom_value)){ 
		while($c_row=mysqli_fetch_array($custom_value)){ 
			$max_day = $c_row['Value'];
		}
	}
	$day = date('d',strtotime($today));
	if($day >= $max_day)
	{
		//$pre_m=date("Y-m-d", strtotime("first day of previous month"));
		//$r_from_date=date("Y-m-d", strtotime($pre_m. "+9 day"));
		$cur_m=date("Y-m-d", strtotime("first day of this month"));
		$r_to_date=date("Y-m-d", strtotime($cur_m. "+8 day"));//today's date+8 days
	}
	if(isset($_SESSION["search_table"]) && $_SESSION["search_table"]!=""){	  
		$reportdetails = get_data("*", "vw_report " .$_SESSION["search_table"]."  ORDER BY rep_date");
	}else{ 
	
		$reportdetails = get_data("*", "vw_report where rep_date<='".$today."' and empid=".$_SESSION["user_id"]." ORDER BY rep_date DESC");
	}
    $output = '<table id="tblreportdetails" class="display" style="width:100%" role="row">
                 <thead>
				    <tr role="row">
				     <th class="w3-hide"> id</th>
					  <th>Project Report Date</th>
				      <th>Employee Name</th>
					 <th>project Name</th>
					  <th>project Task</th>
                     <th>Start Time</th>
					 <th>End Time</th>
					  <th>Total Time</th>
					   <th>Total Time(in hr and min)</th>
					  <th style="width:10%"></th>
				    </tr>
                </thead>
				<tbody role="rowgroup">';
		if (isset($reportdetails)){
			while ($r = mysqli_fetch_array($reportdetails)) {	
				$hr=floor($r["total_time"]/60);
				$min=$r["total_time"]-($hr*60);
				$output = $output . '<tr role="row">
					<td class="w3-hide">' .$r["report_id"] .  '</td>
					<td data-label="Project Report Date">' .  date('d-m-Y', strtotime($r["rep_date"])) . '</td>
					<td data-label="Employee Name">' . $r["first_name"]. '</td>
					<td data-label="Project Name">' . $r["project_name"]. '</td>
					<td data-label="Project Task">' . $r["task"]. '</td>
					<td data-label="Start Time">';
					if($r["start_time"]=="00:00:00")
					{   
					    $output = $output .'';
					}else
					{
						$output = $output .date('h:i:s', strtotime($r["start_time"]));
					}
					$output = $output . '</td>
					<td data-label="End Time">';
					if($r["end_time"]=="00:00:00")
					{   
					    $output = $output .'';
					}else
					{
						$output = $output .date('h:i:s', strtotime($r["end_time"])) ;
					}
					$output = $output . '</td>
					<td data-label="Total Time">';
					if($r['total_time']==0){
						    $output=$output.'ABSENT';
					   }else{
							$output=$output.$r["total_time"];
					   }
					   $output = $output . '</td>';
				  $output=$output.'<td data-label="Total Time(in hr & min)">'.$hr."hr"." ".$min."min".'</td>';
			$output = $output . '<td data-label = "Options">';				
        $output = $output . '<div class = "w3-right">';
		if($edit==1){
			  $output = $output . '<a class = "w3-text-blue w3-large" title="Edit" style="padding:5px" onclick ="edit_report('.$r["report_id"].')"><i class = "fa fa-edit"></i></a>';
		}
		if($delete==1){
			if(isset($r_to_date)  && $r['rep_date'] <= $r_to_date){}else{
				$output = $output . '<a class = "w3-text-red w3-large" style="padding:5px" title="Delete" onclick = "delete_report('.$r["report_id"].')"><i class = "fa fa-trash"></i></a>';
			}
		}
		$output = $output . '</div></td></tr>';
      }
      $output = $output . '</tbody></table>';
    } 
  $_SESSION["search_table"] = "";
  echo $output;
}

if(isset($_POST['report_edit'])) {
    $_SESSION['report_id'] = $_POST['report_id'];
    echo $_SESSION['report_id'];
    exit();
}

if(isset($_POST['report_delete'])) 
{
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['report_id']);
    //echo "call report(@id,'1970-01-01','0','0','0','0','0','1970-01-01 00:00:00','1970-01-01 00:00:00','0','1','$adduserdate','3')";
    $query = mysqli_query($con,"call report(@id,'1970-01-01','0','0','0','0','0','1970-01-01 00:00:00','1970-01-01 00:00:00','0','1','$adduserdate','3')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
	 echo $row['@id'];
	exit();
}

if(isset($_POST['get_clear'])) {
    $_SESSION['report_id'] = "";
 }

if(isset($_POST['search_employee'])) {
    $_SESSION['report_id'] = "";
 }
 
 if(isset($_POST['find_employee']))
{
      $where = "where 1"; //see list of available record when user put no input in search box 
    
	if(isset($_POST['emp_id']) && $_POST['emp_id']!=""){ //when user put some value in search box 
	 $where=$where." and emp_id = '". $_POST['emp_id'] ."'"; 
	        //$where =1 and emp_id=1    
	} 
	$_SESSION["search_table"]=$where;  //$_SESSION["search_table"]=$where -> $where =1 and emp_id=1 ,here both value is append to get data query
	echo $where;// to check $where value ,not compulsory
	
      
	$_SESSION['emp_name'] = $_POST['emp_name'];
     //echo $_SESSION['emp_id'];
	
	
	
}	

if(isset($_POST['check_time']))// ajax variable on line 277
{    
	 $check =get_data("*","tbl_report where empid='" .$_SESSION['user_id'] . "' and rep_date='" . $_POST['r_date'] . "'");
	 if(isset($check)){//set or confirm that variale is present 
	 while($row = mysqli_fetch_array($check))//while loop to check for each record 
	 {   
		 if( $row['start_time'] <= $_POST['r_starttime']  &&  $row['end_time'] > $_POST['r_starttime']  )
	      {
			  echo 1;
		  }	 
	 }
 }	 
 }	
 
 
if(isset($_POST['select_report'])){
	$_SESSION['report_id'] = $_POST['report_id'];
	
	exit();
}

if(isset($_POST['get_excel'])) {
    $_SESSION['p_fromdate'] = $_POST['from_date'];
	$_SESSION['p_todate'] = $_POST['To_date'];
	$_SESSION['project_id'] = $_POST['project_id'];
	$_SESSION['project_name'] = $_POST['project_name'];
	$_SESSION['cost'] = $_POST['cost'];
	$_SESSION['balance'] = $_POST['balance'];
	exit();
}

if(isset($_POST['select_cost'])){
	
	//echo "project_cost,balance ","tbl_project where project_id=" . $_POST['project_id'] . "";
	$check= get_data("project_cost,balance ","tbl_project where project_id='" . $_POST['project_id'] ."' ");
	if(isset($check)){
	 while($row = mysqli_fetch_array($check))
	 {
	     echo $row['project_cost'].'#'.$row['balance'];
		
	}	
	}
}
if(isset($_POST['load_modules'])){
	//echo "select module_name from tbl_quatation_pert where qut_id='".$_POST['project_name']."'";
	$module = get_data("*","tbl_quatation_pert where qut_id='".$_POST['project_name']."'");
	if(isset($module)){
		while($row=mysqli_fetch_array($module)){
			echo "<option value='".$row['qut_pert_id']."' data-id='".$row['qut_pert_id']."'>".$row['module_name']."</option>";	
		}
	}	
}
if(isset($_POST['load_form'])){
	$from=get_data("*","tbl_form_details where qut_id='".$_POST['project_name']."'");
	if(isset($from)){
		while($row=mysqli_fetch_array($from)){
			echo "<option value='".$row['form_detail_id']."' data-id='".$row['form_detail_id']."'>".$row['form_name']."</option>";	
		}
	}
}

?>