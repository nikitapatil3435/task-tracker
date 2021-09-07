<?php
session_start();
include 'db.php';
include 'load_data.php';
//display receipt  details in table 

if(isset($_POST['today_task_table'])){
	?> <a href="" onclick="location.href='today_task_report.php';"> <i class="fa fa-download w3-xxlarge w3-text-blue w3-margin-left" title="Download report"></i></a><?php
	$i=0;		
	$today_task=get_data("*","vw_task where due_date='".date("Y-m-d")."' and is_complete=0 order by due_date DESC");
    $table='<table id="tbl_today_task" class="w3-border w3-small" style="width:100%">
            <thead>
                    <tr>
                        <th class="w3-center">Sr.No</th>
						<th class="w3-center">Project Name</th>
						<th class="w3-center">module name</th>
                        <th class="w3-center">Form name</th>
                        <th class="w3-center">Task Description</th>
                        <th class="w3-center">Due date</th>
                        <th class="w3-center">End date</th>
                        <th class="w3-center">Option</th>
                    </tr>
					
			</thead>
            <tbody>';
        if(isset($today_task)){
			while($row=mysqli_fetch_array($today_task)){
				$i++;
				$table=$table.'<tr id="row'.$row['task_id'].'">
				<td data-label="Sr.No" class="w3-center">'.$i.'</td>
				<td data-label="project_name" class="w3-center" id="project_name'.$row['task_id'].'">'.$row['project_name'].'</td>
				<td data-label="module_name" class="w3-center" id="module_name'.$row['task_id'].'">'.$row['module_name'].'</td>
				
				<td data-label="form_name" class="w3-center" id="form_name'.$row['task_id'].'">'.$row['form_name'].'</td>
				<td data-label="task_description" class="w3-center" id="task_description'.$row['task_id'].'">'.$row['task_description'].'</td>
				<td data-label="due_date" class="w3-center" id="due_date'.$row['task_id'].'">'.$row['due_date'].'</td>
				<td data-label="end_date" class="w3-center" id="end_date'.$row['task_id'].'">'.$row['end_date'].'</td>
				
				 
				<td data-label="Option" class="w3-center">
				<a href="#" id="done" onclick="done_task('.$row['task_id'].')"><i class="fa fa-check w3-large w3-text-green w3-margin-right" title="Done Task"></i></a>
				</td></tr>';
			}
		}
		$table=$table.'</tbody></table>';
	    echo $table; 
}
if(isset($_POST['pending_task_table'])){
	?> <a href="#" onclick="location.href='pending_task_report.php';"> <i class="fa fa-download w3-xxlarge w3-text-blue w3-margin-left" title="Download report"></i></a><?php
	$i=0;		
	//echo "tbl_task where due_date <'".date("Y-m-d")."'";
	$pending_task=get_data("*","vw_task where due_date <'".date("Y-m-d")."' and is_complete=0 order by due_date DESC");
    $table='<table id="tbl_pending_task" class="w3-border w3-small" style="width:100%">
            <thead>
                   <tr>
                        <th class="w3-center">Sr.No</th>
						<th class="w3-center">Project Name</th>
						<th class="w3-center">module name</th>
                        <th class="w3-center">Form name</th>
                        <th class="w3-center">Task Description</th>
                        <th class="w3-center">Assign To</th>
                        <th class="w3-center">Due date</th>
                        <th class="w3-center">End date</th>
                        <th class="w3-center">Option</th>
                    </tr>
					
			</thead>
            <tbody>';
        if(isset($pending_task)){
			while($row=mysqli_fetch_array($pending_task)){
				$i++;
				$table=$table.'<tr id="row'.$row['task_id'].'">
				<td data-label="Sr.No" class="w3-center">'.$i.'</td>
				<td data-label="project_name" class="w3-center" id="project_name'.$row['task_id'].'">'.$row['project_name'].'</td>
				<td data-label="module_name" class="w3-center" id="module_name'.$row['task_id'].'">'.$row['module_name'].'</td>
				
				<td data-label="form_name" class="w3-center" id="form_name'.$row['task_id'].'">'.$row['form_name'].'</td>
				<td data-label="task_description" class="w3-center" id="task_description'.$row['task_id'].'">'.$row['task_description'].'</td>
				<td data-label="assign_to" class="w3-center" id="assign_to'.$row['task_id'].'">'.$row['assign_to'].'</td>
				<td data-label="due_date" class="w3-center" id="due_date'.$row['task_id'].'">'.date('d-m-Y', strtotime($row['due_date'])).'</td>
				<td data-label="end_date" class="w3-center" id="end_date'.$row['task_id'].'">'.date('d-m-Y', strtotime($row['end_date'])).'</td>
				
				 
				<td data-label="Option" class="w3-center">
				<a href="#" id="done" onclick="done_task('.$row['task_id'].')"><i class="fa fa-check w3-large w3-text-green w3-margin-right" title="Done Task"></i></a>
				</td></tr>';
			}
		}
		$table=$table.'</tbody></table>';
	    echo $table; 
}
if(isset($_POST['upcomming_task_table'])){
	?> <a href="" onclick="location.href='upcomming_task_report.php';"> <i class="fa fa-download w3-xxlarge w3-text-blue w3-margin-left" title="Download report"></i></a><?php
	$i=0;		
	$upcomming_task=get_data("*","vw_task where due_date >'".date("Y-m-d")."' and is_complete=0  order by due_date DESC");
    $table='<table id="tbl_upcomming_task" class="w3-border w3-small" style="width:100%">
            <thead>
                   <tr>
                        <th class="w3-center">Sr.No</th>
						<th class="w3-center">Project Name</th>
						<th class="w3-center">module name</th>
                        <th class="w3-center">Form name</th>
                        <th class="w3-center">Task Description</th>
                        <th class="w3-center">Assign To</th>
                        <th class="w3-center">Due date</th>
                        <th class="w3-center">End date</th>
                        <th class="w3-center">Option</th>
                    </tr>
					
			</thead>
            <tbody>';
        if(isset($upcomming_task)){
			while($row=mysqli_fetch_array($upcomming_task)){
				$i++;
				$table=$table.'<tr id="row'.$row['task_id'].'">
				<td data-label="Sr.No" class="w3-center">'.$i.'</td>
				<td data-label="project_name" class="w3-center" id="project_name'.$row['task_id'].'">'.$row['project_name'].'</td>
				<td data-label="module_name" class="w3-center" id="module_name'.$row['task_id'].'">'.$row['module_name'].'</td>
				
				<td data-label="form_name" class="w3-center" id="form_name'.$row['task_id'].'">'.$row['form_name'].'</td>
				<td data-label="task_description" class="w3-center" id="task_description'.$row['task_id'].'">'.$row['task_description'].'</td>
				<td data-label="task_description" class="w3-center" id="task_description'.$row['task_id'].'">'.$row['assign_to'].'</td>
				<td data-label="due_date" class="w3-center" id="due_date'.$row['task_id'].'">'.date('d-m-Y', strtotime($row['due_date'])).'</td>
				<td data-label="end_date" class="w3-center" id="end_date'.$row['task_id'].'">'.date('d-m-Y', strtotime($row['end_date'])).'</td>
				
				 
				<td data-label="Option" class="w3-center">
				<a href="#" id="done" onclick="done_task('.$row['task_id'].')"><i class="fa fa-check w3-large w3-text-green w3-margin-right" title="Done Task"></i></a>
				</td></tr>';
			}
		}
		$table=$table.'</tbody></table>';
	    echo $table; 
}
if(isset($_POST['recent_task_table'])){
	?> <a href="" onclick="location.href='recent_task_report.php';"> <i class="fa fa-download w3-xxlarge w3-text-blue w3-margin-left" title="Download report"></i></a><?php
	$i=0;		
	$recent_task=get_data("*","vw_task where is_complete=1  order by due_date DESC");
    $table='<table id="tbl_recent_task" class="w3-border w3-small" style="width:100%">
            <thead>
                   <tr>
                        <th class="w3-center">Sr.No</th>
						<th class="w3-center">Project Name</th>
						<th class="w3-center">module name</th>
                        <th class="w3-center">Form name</th>
                        <th class="w3-center">Task Description</th>
                        <th class="w3-center">Assign to</th>
                        <th class="w3-center">Due date</th>
                        <th class="w3-center">End date</th>
                        <th class="w3-center">Option</th>
                    </tr>
					
			</thead>
            <tbody>';
        if(isset($recent_task)){
			while($row=mysqli_fetch_array($recent_task)){
				$i++;
				$table=$table.'<tr id="row'.$row['task_id'].'">
				<td data-label="Sr.No" class="w3-center">'.$i.'</td>
				<td data-label="project_name" class="w3-center" id="project_name'.$row['task_id'].'">'.$row['project_name'].'</td>
				<td data-label="module_name" class="w3-center" id="module_name'.$row['task_id'].'">'.$row['module_name'].'</td>
				
				<td data-label="form_name" class="w3-center" id="form_name'.$row['task_id'].'">'.$row['form_name'].'</td>
				<td data-label="task_description" class="w3-center" id="task_description'.$row['task_id'].'">'.$row['task_description'].'</td>
				<td data-label="assign_to" class="w3-center" id="assign_to'.$row['task_id'].'">'.$row['assign_to'].'</td>
				<td data-label="due_date" class="w3-center" id="due_date'.$row['task_id'].'">'.date('d-m-Y', strtotime($row['due_date'])).'</td>
				<td data-label="end_date" class="w3-center" id="end_date'.$row['task_id'].'">'.date('d-m-Y', strtotime($row['end_date'])).'</td>
				
				 
				<td data-label="Option" class="w3-center">
				<a href="#" id="delete" onclick="delete_task('.$row['task_id'].')"><i class="fa fa-trash w3-large w3-text-red w3-margin-right" title="Delete Task"></i></a>
				</td></tr>';
			}
		}
		$table=$table.'</tbody></table>';
	    echo $table; 
}
if(isset($_POST['done_task'])){
	mysqli_query($con, "update tbl_task set is_complete=1 where task_id='".$_POST['task_id']."'");
	echo "1";
}
if(isset($_POST['delete_task'])){
	mysqli_query($con, "update tbl_task set is_complete=0 where task_id='".$_POST['task_id']."'");
	echo "1";
}
if(isset($_POST['edit_task'])) {
    $_SESSION['task_id'] = $_POST['task_id'];
   // echo $_SESSION['task_id'];
    exit();
}
if(isset($_POST['task_bar'])) {
    $_SESSION['task_bar_id'] = $_POST['project_id'];
    echo $_SESSION['task_bar_id'];
    exit();
}

?>
