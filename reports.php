<!DOCTYPE html>
<html>
<head>
	<?php
	include 'header.php';
	include 'dal/load_data.php';
	?>
	<script type="text/javascript" src="jquery/report.js"></script>
</head>
<body>
	<?php
	$menu= 'Reports';
	include 'menu.php';
	?>
	<div class="main_container ">
		<div>
            <h5 class="w3-margin-left" style="color:#1A3257; border-bottom:1px solid #333"><b> <i
                        class="fa fa-file-text w3-margin-right w3-xlarge  w3-padding-small"></i> <span> Reports
                    </span></b></h5>
		</div>
		
		<div class="w3-row-padding w3-margin-top w3-hide">
			<h4 class="w3-left rtabheight">Reports</h4>
		</div>
		<div class="w3-row-padding w3-margin-top">
			<div class="w3-col l6 s12 w3-margin-bottom">
				<label for="Report_type">Select Report</label>
				<input class="w3-hide" id="today" value="<?php echo date("Y-m-d");?>">
				<select class="w3-input w3-border w3-round" name="rid" id="rid" onchange="HideShow()">
					<option value="-1">Select Report Name</option>
					  <option value="1">Todays Report</option>
                      <option value="2">Pending Report</option> 
                      <option value="3">Upcomming Report</option> 
                      <option value="4">Recent Report</option> 
                      <option value="5">Employee Task Report</option> 
				</select>
			</div>
			<div class="w3-row-padding w3-margin-top w3-hide">
				<div class="w3-col l3 s12" id="machine_name_div" style="display:none">
					<label for="machine name">Machine Name</label>
					<input type="text" class="w3-input w3-border w3-round" id="machine_name" name="machine_name" list="machine_list">
						<datalist id="machine_list">
							<?php
								$machine_name = get_data("Distinct machine_id,machine_name,machine_model_num", "tbl_machine");
								if (isset($machine_name)) {
									while ($row= mysqli_fetch_array($machine_name)) {
										echo "<option id='" . $row['machine_id'] . "' value='" . $row['machine_name'] ." - ". $row['machine_model_num'] . "'></option>";
									}
								}
							?>
						</datalist>
				</div>
				<div class="w3-col l3 s12" id="department_name_div" style="display:none">
					<label for="machine name">Department Name</label>
					<input type="text" class="w3-input w3-border w3-round" id="department_name" name="department_name" list="department_list">
						<datalist id="department_list">
							<?php
								$machine_name = get_data("Distinct department_id,department_name", "tbl_department");
									if (isset($machine_name)) {
									while ($row= mysqli_fetch_array($machine_name)) {
									echo "<option id='" . $row['department_id'] . "' value='" . $row['department_name'] ."'></option>";
									}
								}
							?>
						</datalist>
				</div>
				<div class="w3-col l3 s12" id="from_date_div" style="display:none">
					<label for="from date">From Date</label>
					<input type="date" class="w3-input w3-border w3-round" id="from_date" name="from_date">
				</div>
				<div class="w3-col l3 s12" id="to_date_div" style="display:none">
					<label for="To date">To Date</label>
					<input type="date" class="w3-input w3-border w3-round" id="to_date" name="to_date">
				</div>
				<div class="w3-col l3 s12" id="maintenance_type_div" style="display:none">
					<label for="maintenance type">Maintenance</label>
					<input type="text" class="w3-input w3-border w3-round" id="maintenance_type" name="maintenance_type" list="maintenance_list">
						<datalist id="maintenance_list">
							<?php
								$maintenance_type = get_data("Distinct maint_type_id,maint_type","tbl_mainttype");
							
								if (isset($maintenance_type)) {
									while ($row = mysqli_fetch_array($maintenance_type)) {
										echo "<option id='" . $row['maint_type_id'] . "' value='" . $row['maint_type'] . "'></option>";
									}
								}
							?>
						</datalist>
				</div>
				<div class="w3-col l3 s12" id="responsible_person_div" style="display:none">
					<label for="responsible person">Responsible Person</label>
					<input type="text" class="w3-input w3-border w3-round" id="responsible_person" name="responsible_person" list="responsible_person_list">
						<datalist id="responsible_person_list">
						<?php
							$responsible_person = get_data("maint_history_id,responsible_person","tbl_maint_history");
							if (isset($responsible_person)) {
								while ($row = mysqli_fetch_array($responsible_person)) {
									echo "<option id='" . $row['maint_history_id'] . "' value='" . $row['responsible_person'] . "'></option>";
								}
							}
						?>
					    </datalist>
				</div>
				<div class="w3-col l3 s12" id="executed_by_div" style="display:none">
					<label for="executed by">Executed By</label>
					<input type="text" class="w3-input w3-border w3-round" id="executed_person" name="executed_person" list="executed_person_list">
					<datalist id="executed_person_list">
						<?php
							$executed_by = get_data("Distinct maint_history_id,executed_by","tbl_maint_history");
							if (isset($executed_by)) {
								while ($row = mysqli_fetch_array($executed_by)) {
									echo "<option id='" . $row['maint_history_id'] . "' value='" . $row['executed_by'] . "'></option>";
								}
							}
						?>
					</datalist>
				</div>
			</div>
			<div class="w3-row-padding w3-margin-top">
			
				<button id="view_div"class="w3-button w3-border w3-round-xlarge w3-blue w3-right" style="display:none" onclick="generate_pdf()"><i class="fa fa-file-pdf-o w3-margin-right" aria-hidden="true"></i> View</button>
				<?php  if($print==1){?>
				<button id="excel_div" class="w3-button w3-border w3-round-xlarge w3-orange w3-right" style="display:none" onclick="location.href='pending_excel_report.php'"><i class="fa fa-file-excel-o w3-margin-right" aria-hidden="true"></i>View Excel</button>
				<?php }?>
			</div>
		</div>
    </div>
</body>