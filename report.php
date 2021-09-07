<!DOCTYPE html>
<html lang="en">
<head>   
<?php
        include 'header.php';
        require "dal/load_data.php";
?>
   <link rel="stylesheet" type="text/css" href="src/DateTimePicker.css" />
	<script type="text/javascript" src="src/DateTimePicker.js"></script>		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>	
	
  <style>
      .w3-input{padding:2px;
	  height:4vh;}    
      div.dataTables_wrapper {
        margin: 0 auto;
      }      
      .pad2x{padding:2px;}
    </style>
     <script type="text/javascript">
$(document).ready(function() {
		$.ajax
                ({
                  type: 'post',
                  url: 'dal/dal_report.php',
                  data: {
                    fill_reportlist: 'fill_reportlist'
                  }, success: function (response) {
					  debugger;
                    $("#filldata").append(response);
                  }
                });
				$(document).ajaxStart(function () {
				  $("#imgLoading").show();
				}).ajaxStop(function () {
				  $("#imgLoading").hide();
					$('#tblreportdetails').DataTable({
					destroy: true,
					scrollX: true,
					scrollCollapse: true,
					paging: true,
					"ordering":false,
				});	
		});
    });

</script>
    <script src="jquery/report.js" type="text/javascript"></script>
</head>
<body>

<?php
  $serverdate = date('m/d/y');
  $today = date("Y-m-d", strtotime($serverdate));
  $custom_value = get_data("Value","tbl_customsetting where SID=1"); //get value from table  
  if(isset($custom_value)){ //confirm that this value is present 
	while($row=mysqli_fetch_array($custom_value)){ //get that value to $row variable 
		$max_day = $row['Value'];//store this value to $max_day
		//echo $max_day;
	}
}
$day = date('d',strtotime($today)); //get only day from whole date => 1-1-2020 get only 1 date
if($day <= $max_day)//if(13<=14)
{   
    $to_date=$today; //set to date as today
	$first_day = date("Y-m-d", strtotime("first day of previous month"));//get first day of previous month i.e if Jan month then we get '1 jan' date 
	$from_date= date("Y-m-d", strtotime($first_day. "+9 day"));//add 9 days .here we get 10 jan
	//echo $from_date;
}
else//if(16>=14)
{   
    
    $to_date=$today;
	$c_day=date("Y-m-d", strtotime("first day of this month"));//get first day of current month i.e if feb month then we get '1 feb' date 
	$from_date=date("Y-m-d", strtotime($c_day. "+9 day"));//add 9 days .here we get 10 feb
	//echo $from_date;
}	
//suppose today date is 13 jan ,max value is 14feb so it counts month from 10 jan to 14feb .Now suppose today date is 16 feb then it counts month from 10feb to 14 march & continue .. 
// from date 10-01-2020 ,rep_date 13 01 2020,to_date 14 feb 2020 ,go to line 64 and comapare
$menu = 'Daily Task Report';
include 'menu.php';
date("M - Y")."\n";
    ?>
  <?php
   $mode=1;
    if (isset($_SESSION['report_id']) && $_SESSION['report_id'] != "") {
	    $report_id = $_SESSION['report_id'];
        $reportdetails = get_data("*", "vw_report where report_id=" . $_SESSION['report_id'] );
       if(isset($reportdetails )) {
            while ($row = mysqli_fetch_array($reportdetails )) {
                $report_id=$row['report_id'];
				$rep_date=$row['rep_date'];
				$emp_id=$row['empid'];
				$task_status=$row['task_status'];
				$project_name=$row['project_name'];
				$task=$row['task'];				
				$start_time=date('h:i:s',strtotime($row['start_time']));				
				$end_time=date('h:i:s',strtotime($row['end_time']));  
			}
	   }	   
	   $mode=2;
	}
	
	/*$edit_employee = get_data("report_id","tbl_report where emp_id='" . $_SESSION['user_id']."' and rep_date='.rep_date.'"); 
		  if(isset($edit_employee)){ 
			while($e_row=mysqli_fetch_array($edit_employee)){ 
		 $report_id= $e_row['report_id'];}}*/
			
	
?>	   
<div class="w3-container">
        <div class="w3-col s12 l12">
            <div class="w3-left w3-text-black">
                <h3 style="font-family: Jaguar-Bold,SourceSansPro; text-transform: uppercase; margin-left: 10px"
                    class="w3-animate-left ">Daily Task<a href="" onclick="location.href='emp_task_report.php'"> <i class="fa fa-download w3-xxlarge w3-text-blue w3-margin-left" title="Download report"></i></a></h3>                   
            </div>
		</div>          
        <!-- form -->
		<datalist id="project_list">
			<?php 				
			890-
			   $project = get_data("project_id,project_name", "tbl_project");
			   if(isset($project))
			   while($project_list=mysqli_fetch_array($project))
			    { 			
				  echo "<option id =" .$project_list['project_id']. "  value = '".$project_list['project_name']. " '0></option>";
				}			   
		    ?>
         </datalist>		
		<div class="w3-row-padding w3-margin-top">
                <div class="w3-col s12 l3 w3-row-padding">
                    <label>Task Date</label>
                    <input type="date" class="w3-input w3-border w3-round" id="r_date" name="r_date" value="<?php if(isset($rep_date)) {echo $rep_date;}else{  echo date("Y-m-d"); } ?>" onblur="date_change()"> 
					<input class="w3-hide" id="report_id" value="<?php if(isset($report_id)){ echo $report_id;} else{ echo '0';}?>">
					<input class="w3-hide" id="today_date" value="<?php if(isset($today)) {echo $today;}?>">
					<input class="w3-hide" id="mode" value="<?php if(isset($mode)){ echo $mode;} ?>">
					<input class="w3-hide" id="from_date" value="<?php if(isset($from_date)){ echo $from_date;} ?>">
					<input class="w3-hide" id="to_date" value="<?php if(isset($to_date)){ echo $to_date;} ?>">
				</div>				
                <div class="w3-col s12 l3 w3-row-padding">
					<label>Employee Name</label>
					<input type="text" class="w3-input w3-border w3-round" name="employee_name" id="employee_name" value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];} ?>" disabled> 
				</div>			     	
                <div class="w3-col s12 l3 w3-row-padding">					
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
                    <label>Task</label>
                    <textarea  type="text" name="task" id="task" class="w3-input w3-border w3-text-black w3-round"
                        cols="30" rows="1"><?php if(isset($task)){ echo $task;} ?></textarea>
                </div>              
                <div class="w3-col s12 l3 w3-row-padding">
                    <label>Start Time</label>
                    <input type="time" class="w3-input w3-border apply_plugin w3-round" id="start_time" name="start_time" data-format="HH:mm AA" value="<?php if(isset($start_time)){ echo $start_time;} ?>" onchange="check_time(),chk_time()">
                </div>			   
				<div class="w3-col s12 l3 w3-row-padding">
                    <label>End Time</label>
                    <input type="time" class="w3-input w3-border apply_plugin w3-round" id="end_time" name="end_time" data-format="HH:mm AA" value="<?php if(isset($end_time)){ echo $end_time;} ?>" onchange="chk_time()">
				</div>	
                <div class="w3-col s12 l3 w3-row-padding w3-hide">
                    <label>Total Time</label>
                    <input type="text" class="w3-input w3-border apply_plugin w3-round" id="total_time" name="total_time" data-format="HH:mm AA" value="<?php if(isset($end_time)){ echo $end_time;} ?>" onchange="chk_time()">
				</div>	
                <div class="w3-col s12 l3 w3-row-padding">
					<label>Task Status</label>
					<select class="w3-input w3-border w3-round" style="padding:0px;margin=0px;"  name="task_status" id="task_status">
						<option disabled selected value="">--Select Task Status--</option>
						<option value="In-Progress" <?php if(isset($task_status) && $task_status=="In-Progress"){ echo "selected";}?>>In-Progress</option>
						<option value="Completed" <?php if(isset($task_status) && $task_status=="Completed"){ echo "selected";}?>>Completed</option>
					</select>
				 </div>					
				<div class="w3-row-padding w3-margin-top">
					<button type="button" name="submit" id="save" class="w3-button w3-blue w3-right" onclick="save_report()"><i class="fa fa-save"
                           style="padding:5px;"></i>Save</button>
						   
				</div>				
		</div>		
				<br>
                <div class="w3-left w3-text-black">
                 <h4 style="font-family: Jaguar-Bold,SourceSansPro; text-transform: uppercase; margin-left: 10px"
                    class="w3-animate-left ">Report list</h4>
                </div><br>				
				<div id="filldata"></div>				
				<?php
				// echo $_SESSION['pid'];
				?>				
        
<div id="dtBox"></div>
 <script type="text/javascript">
	$(document).ready(function(){
		debugger;
		$(".dtBox").DateTimePicker();

	});
</script>
</body>
</html>