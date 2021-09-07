<!DOCTYPE html>
<html>
<head>
	<?php
	include 'header.php';
	include 'dal/load_data.php';
	?>
	<script type="text/javascript" src="jquery/project_report.js"></script>
</head>
<body>
	<?php
	//$menu= 'Reports';
	//include 'menu.php';
	?>
	<div class="w3-container ">
		<div class="w3-row-padding w3-margin-top">
			<h4 class="w3-left rtabheight">Reports</h4>
		</div>
		<div class="w3-row-padding">
			<div class="w3-col l6 s12 w3-margin-bottom">
				<label for="Report_type">Type of Report</label>
				<input class="w3-hide" id="today" value="<?php echo date("Y-m-d");?>">
				<select class="w3-input w3-border w3-round" name="rid" id="rid" onchange="HideShow()">
					<option value="-1">Select Report Name</option>
					<?php
                        $result = get_data("Distinct rid,reportname", "tbl_reportname where IsActive =1 order by rid");
                        if (isset($result)) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option class='w3-text-black' value=" . $row['rid'] . ">" . $row['reportname'] . "</option>";
                            }
                        }
					?>
				</select>
			</div>
			<div class="w3-row-padding w3-margin-top">
				<div class="w3-col l3 s12" id="project_name_div" style="display:none">
					<label for="machine name">Project Name</label>
					<input type="text" class="w3-input w3-border w3-round" id="project_name" name="project_name" list="project_list">
						<datalist id="project_list">
							<?php
								$project_name = get_data("Distinct qut_id,project_name", "tbl_quatation_master");
								if (isset($project_name)) {
									while ($row= mysqli_fetch_array($project_name)) {
										echo "<option id='" . $row['qut_id'] . "' value='" . $row['project_name'] ."'></option>";
									}
								}
							?>
						</datalist>
				</div>
				<div class="w3-col l3 s12" id="employee_name_div" style="display:none">
					<label for="machine name">Employee Name</label>
					<input type="text" class="w3-input w3-border w3-round" id="emp_name" name="emp_name" list="employee_list">
						<datalist id="employee_list">
							<?php
								$emp_name = get_data("Distinct empid,first_name", "tbl_employee_detail");
									if (isset($emp_name)) {
									while ($row= mysqli_fetch_array($emp_name)) {
									echo "<option id='" . $row['empid'] . "' value='" . $row['first_name'] ."'></option>";
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
								
			</div>
			<div class="w3-row-padding w3-margin-top">
			
				<button id="view_div"class="w3-button w3-border w3-round-xlarge w3-blue w3-right" style="display:none" onclick="generate_pdf()"><i class="fa fa-file-pdf-o w3-margin-right" aria-hidden="true"></i> View</button>
				<button id="excel_div" class="w3-button w3-border w3-round-xlarge w3-orange w3-right" style="display:none" onclick="location.href='pending_excel_report.php'"><i class="fa fa-file-excel-o w3-margin-right" aria-hidden="true"></i>View Excel</button>
			
			</div>
		</div>
    </div>
</body>