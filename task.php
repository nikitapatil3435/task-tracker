<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include 'header.php';
  require "dal/load_data.php";
?>

    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="plugins/jquery.dataTables.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/responsivetables.css">
    <script src="jquery/task.js" type="text/javascript"></script>
    <style>
  #gif {
        z-index:9999999;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -50px 0px 0px -50px;
    }
	.w3-input {
        padding: 0 px;
		height:4vh;
		//margin:3px;
    }
	tbody
	{
		display:block;
		overflow:auto;
		height:270px;
	}
    thead,
    tbody tr {
        display: table;
        width: 100%;
		font-family: 'Tangerine', serif;
	
    }
    table {
        width: 100%;
    }
    label{
		font-family: 'Tangerine', serif;
		margin-top:5px;
		
	}
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {
        thead {
            width: calc(100% - 4px)
        }
    }	
    </style>
  </head>
  <body>
  <?php  
  $serverdate = date('m/d/y');
  $today = date("Y-m-d", strtotime($serverdate));
  //echo $menu;
  $menu = 'Task Scheduling';
  include 'menu.php';
  ?>  
  <?php
     //  $_SESSION['employee_id']="";
	 $mode=1;
    if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != "") {// get edit session
        //Master Details
       $task_details = get_data("*", "tbl_task where task_id =" . $_SESSION['task_id']); //get id using where clause
       if (isset($task_details )) {//confirm that this variable is exist or not
            while ($row = mysqli_fetch_array($task_details)) {//check for each row
                $task_id=$row['task_id'];
                $project_name=$row['project_id'];
                $module_name=$row['module_id'];
                $form_name=$row['form_id'];
                $task_description=$row['task_description'];
                $assigned_to=$row['assign_to'];
                $due_date = date("Y-m-d", strtotime($row['due_date']));
			    $end_date =date("Y-m-d", strtotime($row['end_date']));
                              
           }
       }
       $mode=2;
    //$pert = get_data("*", "tbl_employee_pert where emp_id =" . $_SESSION['employee_id']);
   }
	?><?php
	 // echo $left_date;?>
	<div id='imgLoading' class="w3-overlay w3-text-aqua"><i id="gif" class="fa fa-spinner w3-spin" style="font-size:64px"></i></div>
	<div>
        <div class="w3-col s12 l12">
            <div class="w3-left w3-text-black ">
                <h3 style="font-family: Jaguar-Bold,black; text-transform: uppercase; margin-left: 10px"
                    class="w3-animate-left ">Task Allocation</h3>
            </div>		  
			
            <div class="w3-col s12 m12 l3 w3-right">
				<button type="button" name="submit" class="w3-button w3-blue w3-right w3-margin-top w3-margin-right"  onclick="location.href='task_list.php';"><i class="fa fa-search"
                style="padding:5px;"></i>Search</button>
				<button type="button" name="reload" title="Refresh Page" class="w3-button w3-blue w3-right w3-margin-top w3-margin-right" onclick="clear_session()"><i class="fa fa-refresh"
               ></i></button>
            <br>
            </div>
        <br>
        <!-- form -->
        <form action="" method="post">
				<div class="w3-row-padding w3-margin-top">
					  <div class="w3-col s11 l3 w3-row-padding">
						<input class="w3-hide" id="task_id" value="<?php if(isset($task_id)){ echo $task_id;} else{ echo '0';}?>">
						<input class="w3-hide" id="mode" value="<?php if(isset($mode)){ echo $mode;} ?>">
					    <label>project Name</label>
					<select name="project_name" class="w3-input w3-border w3-round w3-padding-small" id="project_name" onchange="load_modules();load_form()">
					   <option value="">-- Select Project Name--</option>
						<?php
							$project_id=get_data("qut_id,project_name","tbl_quatation_master");	
							if (isset($project_id)) {
								while ($row = mysqli_fetch_array($project_id)) {
									if (isset($project_name) && $project_name == $row['project_id']) {
										echo "<option selected value='" . $row['project_id'] . "'>" . $row['project_name'] . "</option>";
									} else {
										echo "<option  class='w3-text-black' value=" . $row['qut_id'] . ">" . $row['project_name'] . "</option>";
									}
								}
							}
						  ?>				  
					 </select>
						</div>
					 
					 <div class="w3-col s12 l3 w3-row-padding">
						<label>Module Name</label>
						<select name="module_name" class="w3-input w3-border w3-round w3-padding-small" id="module_name">
					   <option value="">-- Select Module Name--</option>
						<?php
							$module_id=get_data("qut_pert_id,module_name","tbl_quatation_pert");	
							if (isset($module_id)) {
								while ($row = mysqli_fetch_array($module_id)) {
									if (isset($module_name) && $module_name == $row['qut_pert_id']) {
										echo "<option selected value='" . $row['qut_pert_id'] . "'>" . $row['module_name'] . "</option>";
									} else {
										echo "<option  class='w3-text-black' value=" . $row['qut_pert_id'] . ">" . $row['module_name'] . "</option>";
									}
								}
							}
						  ?>				  
					 </select>
					 </div>
					<div class="w3-col s12 l3 w3-row-padding">
						<label>Form Name</label>
						<select name="form_name" class="w3-input w3-border w3-round w3-padding-small" id="form_name" >
					   <option value="">-- Select form Name--</option>
					   
						<?php
						
							$form_id=get_data("form_detail_id,form_name","tbl_form_details");	
							if (isset($form_id)) {
								while ($row = mysqli_fetch_array($form_id)) {
									if (isset($form_name) && $form_name == $row['form_detail_id']) {
										echo "<option selected value='" . $row['form_detail_id'] . "'>" . $row['form_name'] . "</option>";
									} else {
										echo "<option  class='w3-text-black' value=" . $row['form_detail_id'] . ">" . $row['form_name'] . "</option>";
									}
								}
							}
						  ?>				  
					 </select>
					</div>				 
				    <div class="w3-col s12 l3 w3-row-padding">
						<label>Task Description</label>
						<textarea  type="text" name="task" id="description" class="w3-input w3-border w3-text-black w3-round"
                        cols="30" rows="1"><?php if(isset($task_description)){ echo $task_description;} ?></textarea>
					</div>
					 <div class="w3-col s12 l3 w3-row-padding">
						<label>Assigned To</label>
						<select name="assigned_to" class="w3-input w3-border w3-round w3-padding-small" id="assigned_to">
					   <option value="">-- Select Employee--</option>
						<?php
							$assign_to=get_data("empid,first_name","tbl_employee_detail");	
							if (isset($assign_to)) {
								while ($row = mysqli_fetch_array($assign_to)) {
									if (isset($assigned_to) && $assigned_to == $row['empid']) {
										echo "<option selected value='" . $row['empid'] . "'>" . $row['first_name'] . "</option>";
									} else {
										echo "<option  class='w3-text-black' value=" . $row['empid'] . ">" . $row['first_name'] . "</option>";
									}
								}
							}
						  ?>				  
					 </select>
					 </div>
					<div class="w3-col s12 l3 w3-row-padding">
						<label>Due Date</label>
						<input type="date" class="w3-input w3-border w3-round"  id="due_date" name="due_date" value="<?php if(isset($due_date)){ echo $due_date;} ?>">
                    </div>	
                    <div class="w3-col s12 l3 w3-row-padding">
						<label>End Date</label>
						<input type="date" class="w3-input w3-border w3-round"  id="end_date" name="end_date" value="<?php if(isset($end_date)) {echo $end_date;} ?>">
                    </div>	
					<div class="w3-col s12 l3 w3-row-padding w3-hide">
						<label>Total Minutes</label>
						<input type="text" class="w3-input w3-border w3-round"  id="total_minutes" name="total_minutes" value="<?php if(isset($left_date)){ echo $left_date;} ?>">
                    </div>						
					 			 
                  </div>					 
				 <br><br>	           
			    <div class="w3-row-padding">               
					<div class="w3-col s13 m13 l30">
						<button type="button" name="submit" class="w3-button w3-blue w3-right"  onclick="save_task()"><i class="fa fa-save"
							   style="padding:5px;"></i>Allocate Task</button>
					</div>
				</div>
				
				<?php
				   //echo $_SESSION['employee_id'];
				?>
		</form>
	</div>	
    </div>
	</body>
</html>
       
			