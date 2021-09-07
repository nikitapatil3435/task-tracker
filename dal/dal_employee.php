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
$rights = get_data("is_allowed,`insert`,`edit`,`delete`,`print`,`approve`", "vw_rolewiserights where menu='Employee' and role_id=" . $_SESSION['role_id']);
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
//save employee details
if(isset($_POST['get_save'])) {
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['emp_id']);
	//echo "call employee_details(@id,'$_POST[first_name]','$_POST[middle_name]','$_POST[last_name]','$_POST[joining_date]','$_POST[left_date]','$_POST[employee_role]','$_POST[emp_address]','$_POST[email]','$_POST[reporting_authority]','$_POST[gender]','$_POST[is_team_lead]','$_POST[user]','123','$_POST[employee_role]','1','$adduserdate','$_POST[mode]')";
	$query = mysqli_query($con,"call employee_details(@id,'$_POST[first_name]','$_POST[middle_name]','$_POST[last_name]','$_POST[joining_date]','$_POST[left_date]','$_POST[employee_role]','$_POST[emp_address]','$_POST[email]','$_POST[reporting_authority]','$_POST[gender]','$_POST[is_team_lead]','$_POST[user]','123','$_POST[employee_role]','1','$adduserdate','$_POST[mode]')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
    echo $row['@id'];
	$_SESSION['employee_id'] = $row['@id'];
	exit();
}
if(isset($_POST['pert_save'])) {
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['emp_pert_id']);
	$query = mysqli_query($con,"call employee_pert(@id,'$_POST[emp_id]','$_POST[emp_fdate]','$_POST[emp_tdate]','$_POST[emp_min]','1','$adduserdate','$_POST[mode]')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
    echo $row['@id'];
	exit();
}
if(isset($_POST['fill_employeelist'])) {
  $employeedetails = get_data("*", "tbl_employee_detail");
    $i=0;
    $output = '<table id="tblemployeedetails" class="w3-border" style="width:100%">
                 <thead>
				    <tr>
				     <th class="w3-center">SR.No</th>
					  <th class="w3-center">Name</th>
				      <th class="w3-center">Joinning Date</th>					  
					  <th class="w3-center">Address</th>	
                      <th class="w3-center">Email</th>
					  <th class="w3-center">Options</th>
				    </tr>
                </thead>
				<tbody>';
if (isset($employeedetails)) {
	while ($r = mysqli_fetch_array($employeedetails )) {
        $i++;		
        $output = $output . '<tr>
                  <td class="w3-center">' .$i .  '</td>
					<td class="w3-center">' . $r["first_name"] .'  '. $r["last_name"] . '</td>
					<td class="w3-center">' .  date('d-m-Y', strtotime($r["joinging_date"])) . '</td>					
					<td class="w3-center">' . $r["address"]. '</td>
					<td class="w3-center">' . $r["email"]. '</td>';
					
        $output = $output . '<td data-label = "Options" class="w3-center">';				
        //$output = $output . '<div class = "w3-right">';
		if($edit==1){
			$output = $output . '<a w3-text-blue w3-margin-right w3-large onclick = edit_employee('.$r["empid"].',"employee.php")><i class = "fa fa-edit w3-text-blue w3-margin-right w3-large"></i>&nbsp;</a>';
		}
		if($edit == 1){
                  $output = $output . '<a href = "#" onclick =edit_profile(' . $r["empid"] . ',"customerContact.php")><i class = "fa fa-phone w3-text-blue w3-margin-right w3-large w3-border"></i>&nbsp;</a>';
        }
		if($delete==1){
			$output = $output . '<a onclick = "delete_employee('.$r["empid"].')"><i class = "fa fa-trash w3-text-red w3-margin-right w3-large"></i>&nbsp;</a>';
		}
		$output = $output . '</tr>';
		}
      $output = $output . '</tbody></table>';
    }
  $_SESSION["search_table"] = "";
  echo $output;
}
if(isset($_POST['get_edit'])) {
    $_SESSION['employee_id'] = $_POST['emp_id'];
    echo $_SESSION['employee_id'];
    exit();
}
//delete employee details
if(isset($_POST['get_delete'])) 
{
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['emp_id']);	
	//echo "call employee_details(@id,'$_POST[emp_name]','$_POST[emp_date]','$_POST[emp_ldate]','$_POST[emp_addr]','1','$adduserdate','$_POST[mode]')";
	$query = mysqli_query($con,"call employee_details(@id,'0','0','0','1990-01-01','1990-01-01','0','0','0','0','0','0',0,0,'0','0','$adduserdate','3')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
	//$_SESSION['employee_id'] = '';
	echo $row['@id'];
	exit();
}
if(isset($_POST['get_clear'])) {
    $_SESSION['employee_id'] = "";
 } 
if(isset($_POST['search_employee'])) {
    $_SESSION['employee_id'] = "";
 } 
 if(isset($_POST['get_delete_pert'])) {
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['id']);
	$query = mysqli_query($con,"call employee_pert(@id,'0','1970-01-01','1970-01-01','0','1','$adduserdate','3')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
}
if(isset($_POST['approve_list'])) {
    $serverdate = date('m/d/y');
	 $today = date("Y-m-d", strtotime($serverdate));
	 if(isset($_SESSION['search_table']) && ($_SESSION['search_table'])!="") {
			if(isset($_SESSION['type']) && $_SESSION['type']==2){
				$data = get_data("emp_id,emp_name,SUM(total_time) as  total,rep_date,is_approve","vw_report ". $_SESSION["search_table"]." and is_approve=1 GROUP BY emp_name,rep_date ORDER BY rep_date");                    
			}else{
				$data = get_data("emp_id,emp_name,sum(total_time) as total ,is_approve,rep_date","vw_report ". $_SESSION["search_table"]." and is_approve=0  GROUP BY rep_date,emp_name ORDER BY rep_date");		 
			}
			$record=get_data("distinct emp_name,sum(diff) as diff","vw_datewise_difference  " .$_SESSION["search_table"]." group by emp_name order by emp_id");
		}else{
			$adduserdate = date('Y-m-d h:m:s');
			$fromdate = date('Y-m-d', strtotime('-7 days'));
			$todate = date('Y-m-d', strtotime($adduserdate)); 
			if(isset($_SESSION['type']) && $_SESSION['type']==2){
				$data = get_data("emp_id,emp_name,sum(total_time) as total ,is_approve,rep_date","vw_report where (date(rep_date) between '" . $fromdate . "' and '" . $todate . "')  and is_approve=1  GROUP BY rep_date,emp_name ORDER BY rep_date");		 
			}else{
				$data = get_data("emp_id,emp_name,sum(total_time) as total ,is_approve,rep_date","vw_report where (date(rep_date) between '" . $fromdate . "' and '" . $todate . "') and is_approve=0  GROUP BY rep_date,emp_name ORDER BY rep_date");		  
			}
		}  
	if(isset($record)){
	   while($r= mysqli_fetch_array($record)) {
			echo"<span class='w3-padding'><b>".$r['emp_name'].":</b>".$r['diff']."</span>";
		}
	}
	$icon_class="";
	if(isset($_SESSION['type']) && $_SESSION['type']==2){
	    $icon_class="w3-hide";
	}	
	$output= '<table id="tblapprove" class="display" style="width:100%">
					<thead>
						<tr>
						   <th >Report Date</th>
						   <th >Employee Name</th>
						   <th>Total Time</th>
						  <th >Total in Minute</th>
						  <th>Total in hr n min</th>';
						  if($icon_class==""){
							$output= $output.'<th style ="width:10%">Approve</th>';
						  }
						$output= $output.'</tr>
                </thead>
				<tbody>';
			     if(isset($data)){
					while ($row = mysqli_fetch_array($data)) {
                    $count=480-$row['total'];
					$hr=floor($count/60);
					$min=$count-($hr*60);
					$rep_date_str = "'".$row["rep_date"]."'";
					$approve=$row["is_approve"];
					
					if($row['total']<480)
					{ $display="";
				      if(date("l", strtotime($row['rep_date']))=="Sunday")
						{
							$color="w3-yellow";
							
						}else{
							$color="";
						}
						
                      $output=$output.'<tr class="'.$color.'">
                       <td data-label="Report Date">'.date("d-m-Y", strtotime($row['rep_date'])).'</td>
                       <td data-label="Employee Name">'.$row['emp_name'].'</td>
					   <td data-label="Total Time" >';
					   if($row['total']==0){
						    $output=$output.'ABSENT';
					   }else{
							$output=$output.$row['total'];
							
					   }
					$output=$output.'</td>
					<td data-label="Total Time" >';					
					   if($row['total']==0){
					        $output=$output.$row['total'];
					 }else{
							$output=$output.$count;
					    }
						$output=$output.'</td>
						<td data-label="Total Time in Hr min" >';			
					 if($row['total']==0){
					      $output=$output.$row['total']."hr"." ".$row['total']."min";
						  
					 }else
					  {
						$output=$output.$hr."hr"." ".$min."min";
					    }
					$output=$output.'</td>';
					if($row["is_approve"]==0){
						$output=$output.'<td style ="width:10%"><a class = "w3-text-green w3-large w3-center" style="padding:5px" onclick = "approve_entry('.$row["emp_id"].','.$rep_date_str.')"><i class = "fa fa-check-circle"></i></a></td>';
					} $output = $output . '</tr>';
					}
				    }
					 $output= $output.'</tbody>
            </table>';
       }
	 
  $_SESSION["search_table"] = "";
  $_SESSION["from_date"] = "";
  $_SESSION['To_date']="";
  echo $output;
}

if(isset($_POST['get_check'])) {
	mysqli_query($con, "set @id =0");
	//echo "call report(@id,'$_POST[rep_date]','$_POST[emp_id]','-','0','00:00:00','00:00:00','1','1900-01-01',4)";
	mysqli_query($con,"call report(@id,'$_POST[rep_date]','$_POST[emp_id]','-','0','00:00:00','00:00:00','1','1900-01-01',4)");
}
if(isset($_POST['appr_type'])){
	$_SESSION['type'] = $_POST['type'];
}

if(isset($_POST['find_employee'])){
    $where = "where 1"; 
    if(isset($_POST['from_date']) && $_POST['from_date']!="" && isset($_POST['To_date']) && $_POST['To_date']!="" ){ 
	    $where=$where." and date(rep_date) between '". $_POST['from_date'] ."' and '". $_POST['To_date'] ."' "; 
	} 
	$_SESSION["search_table"]=$where;  
	echo $where;
	$_SESSION['from_date'] = $_POST['from_date'];
	$_SESSION['To_date'] = $_POST['To_date'];
}	
if(isset($_POST['edit_profile'])){
		$_SESSION['employee_id'] = $_POST['PrfId'];
		exit();
   }
//save pert for contact details
if(isset($_POST['save_pert'])){
  $adduserdate = date('Y-m-d h:m:s');
  echo "call ProfilePert($_POST[PPId],$_SESSION[employee_id],$_POST[ctype],'$_POST[details]','$_POST[remark]','$_POST[is_default]','','0','0',$_POST[AddUserId],'$adduserdate',$_POST[mode])";
  $profilepert = mysqli_query($con, "call ProfilePert($_POST[PPId],$_SESSION[employee_id],$_POST[ctype],'$_POST[details]','$_POST[remark]','$_POST[is_default]','','0','0',$_POST[AddUserId],'$adduserdate',$_POST[mode])");
   exit();
}
?>	
