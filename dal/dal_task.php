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
if(isset($_POST['save_task'])) {
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['task_id']);
	//echo "call task(@id,'$_POST[project_name]','$_POST[module_name]','$_POST[form_name]','$_POST[task_description]','$_POST[assign_to]','$_POST[due_date]','$_POST[end_date]','1','$adduserdate','$_POST[mode]')";
	$query = mysqli_query($con,"call task(@id,'$_POST[project_name]','$_POST[module_name]','$_POST[form_name]','$_POST[task_description]','$_POST[assign_to]','$_POST[due_date]','$_POST[end_date]','0','1','$adduserdate','$_POST[mode]')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
    echo $row['@id'];
	$_SESSION['task_id'] = $row['@id'];
	exit();
}
if(isset($_POST['edit_task'])) {
    $_SESSION['task_id'] = $_POST['task_id'];
   // echo $_SESSION['task_id'];
    exit();
}
if(isset($_POST['get_clear'])) {
    $_SESSION['task_id'] = "";
 } 
 

if(isset($_POST['task_details_table'])){
	$i=0;
	$task_details=get_data("*","vw_task order by due_date DESC");
    $table='<table id="tbl_task_details" class="w3-border w3-small" style="width:100%">
            <thead>
                    <tr>
                        <th class="w3-center">Sr.No</th>
						<th class="w3-center">Project Name</th>
						<th class="w3-center">Module name</th>
                        <th class="w3-center">From Name</th>
                        <th class="w3-center">Task Description</th>
                        <th class="w3-center">Due date</th>
                        <th class="w3-center">End date</th>
                        <th class="w3-center">Options</th>
                        
                    </tr>
					
			</thead>
            <tbody>';
        if(isset($task_details)){
			while($row=mysqli_fetch_array($task_details)){
				$i++;
				$table=$table.'<tr id="row'.$row['task_id'].'">
				<td data-label="Sr.No" class="w3-center">'.$i.'</td>
				<td data-label="project_name" class="w3-center" id="project_name'.$row['task_id'].'">'.$row['project_name'].'</td>
				
				<td data-label="module_name" class="w3-center" id="module_name'.$row['task_id'].'">'.$row['module_name'].'</td>
				<td data-label="from_name" class="w3-center" id="from_name'.$row['task_id'].'">'.$row['form_name'].'</td>
				<td data-label="task_description" class="w3-center" id="task_description'.$row['task_id'].'">'.$row['task_description'].'</td>
				<td data-label="due_date" class="w3-center" id="due_date'.$row['task_id'].'">'.$row['due_date'].'</td>
				<td data-label="end_date" class="w3-center" id="end_date'.$row['task_id'].'">'.$row['end_date'].'</td>				  		
				<td data-label="Option" class="w3-center">
				<a href="#" id="edit" onclick = "edit_task('.$row["task_id"].')"><i class="fa fa-edit w3-large w3-text-green w3-margin-right" title="Edit"></i></a>
				<a href="#" onclick="delete_task('.$row['task_id'].')"><i class="fa fa-trash w3-large w3-text-red" title="Delete"></i></a>
				
				</td></tr>';
			}
		}
		$table=$table.'</tbody></table>';
	    echo $table; 
}
//Delete task
if (isset($_POST['delete_task']))
{
    $adduserdate = date('Y-m-d h:m:s');
    mysqli_query($con, "set @id =" . $_POST['task_id']);
	//echo "call machine(@id,'0','0','0','0',0,'$adduserdate','3')";
    mysqli_query($con, "call task(@id,'0','0','0','0','0','1990-01-01','1990-01-01','0',0,'$adduserdate','3')");
	//$_SESSION['task_id'] = '';
	echo $row['@id'];
    exit();
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