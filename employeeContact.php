<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'header.php';
	require 'dal/load_data.php';
    ?>
	<script src="jquery/employee.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"> </script>
		<link href="css/datatable.css" rel="stylesheet" type="text/css"/>
		<link href="css/responsivetables.css" rel="stylesheet" type="text/css"/>
        <link href="css/common.css" rel="stylesheet" type="text/css"/>
		<script src="plugins/jquery.dataTables.min.js" type="text/javascript"></script>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
		<style>
			tbody {
              display: block;
              overflow: auto;
			  font-family: 'Tangerine', serif;
            }
        thead,
        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
            padding: 2px;
			font-family: 'Tangerine', serif;
        }
         table {
            width: 100%;
        }
			.w3-input{
			padding:0px;
			height:4vh;
			font-family: 'Tangerine', serif;
		}
		</style>
</head>
<body>
    <div class="wrapper hover_collapse">
        <?php
		
			$menu = 'Employee';
			include 'menu.php';
			//$page_name = "Contact And Other Details";
			$AddUserId = 1;
			if(isset($_SESSION['employee_id']) && $_SESSION['employee_id'] != ""){
				//echo "*", "tbl_employee_detail where empid=" . $_SESSION['employee_id'];
				$profiledata = get_data("*", "tbl_employee_detail where empid=" . $_SESSION['employee_id']);
				while($row = mysqli_fetch_array($profiledata)) {
					$EmpId = $row['empid'];
					$EmpName = $row['first_name'].' '.$row['last_name'];
				}
				$profilepert = get_data("PPId,empid,CTypId,Value,Remark,IsSE", "tbl_profilepert where empid=" . $_SESSION['employee_id']);
			}	
		?>
        <div class="main_container">
		
			 <div class="w3-row-padding">
                <div class="w3-col s12 l12 m12 w3-border-bottom w3-margin-top">
                     <label for="" class="w3-left" style="font-family: 'Tangerine', serif; font-size:20px;"> <i class="fa fa-phone"></i> Contact Details</label>
                     <?php
					    if(isset($EmpName)){
							echo "<p class='w3-right'><b >Employee: " . $EmpName . "</b></p>";
						}
					  ?>
				 </div>
			 </div>
			 <input class="w3-hide" id="PrfId" value="<?php
        if(isset($EmpId)){
          echo $EmpId;
        } else{
          echo '0';
        }
        ?>">
			  <input class="w3-hide" id="AddUserId" value="<?php
			  if(isset($AddUserId)){
				 echo $AddUserId;
			  }else{
			    echo '0';
			 }
			 ?>">
            <div class="w3-row-padding w3-margin-top" id="contact_table">
                <table id="mytable" style="width: 100%;" role="row">
                    <thead>
                        <tr role="rowgroup">
                            <th class="col_type w3-center">Type</th>
                            <th class="col_details w3-center">Details</th>
                            <th class="col_remark w3-center">Remark</th>
                            <th class="col_option w3-center"></th>
                        </tr>
                    </thead>
                    <tbody>	
						<?php
							$is_fixed = 0;
							$table_setting = get_data("Value", "tbl_customsetting where SName='contact_table' and Value=1");
							if(isset($table_setting)){
								$is_fixed = 1;
							}
							$i = 0;
							if($is_fixed == 0){
								$contact_details = get_data("*", "v_profilepert where empid=" . $_SESSION['employee_id'] . " order by PPId");
								if(isset($contact_details)){
									while ($pert = mysqli_fetch_array($contact_details)) {
										$i++;
									  ?> 
										<tr role="rowgroup" id="row_<?php echo $i; ?>">	
											<td data-label="" class="col_type">
												<select disabled class="w3-input w3-border" id="s_ctype<?php echo $i; ?>"  onblur="validate_type(<?php echo $i; ?>)">	
													<option disabled>Select Type<option>
													<?php
														$contact_type = get_data("ctype_id,contact_type,active_mode,validation", "tbl_validations where active_mode=1 and Is_DC=0 order by ctype_id ");
														while ($row = mysqli_fetch_array($contact_type)) {
															if($row['ctype_id'] == $pert['Value']){
																echo "<option selected data-ex='" . $row['validation'] . "' data-active='" . $row['active_mode'] . "' value=" . '"' . $row['CTypId'] . '"' . "&quot;>" . $row['contact_type'] . "</option>";
															} else{
																echo "<option data-ex='" . $row['validation'] . "' data-active='" . $row['active_mode'] . "' value=" . '"' . $row['ctype_id'] . '"' . "&quot;>" . $row['contact_type'] . "</option>";
															  }
														}
													?>
												</select>
											</td>
											<td data-label="" class="col_details"><input class="w3-input w3-border w3-round" id="s_details<?php echo $i; ?>" onblur="validate(<?php echo $i; ?>)" maxlength="10" value="<?php echo $pert['Value']; ?>" ></td>
											<td data-label="" class="col_remark"><input class="w3-input w3-border w3-round" id="s_remark<?php echo $i; ?>" ></td>
											<td data-label="Option" class="col_type">
												<a href="#" class="w3-text-red w3-hover-text-blue w3-hide" style="padding: 5px 5px 5px 5px;" value="save"  onclick="delete_row(<?php echo $i; ?>);" ><b><i class="fa fa-plus w3-border w3-padding-small w3-round w3-text-green"></i>1</b></a>
												<input class="w3-hide" id="s_mode<?php echo $i; ?>" value='2'>                            
												<input class="w3-hide" id="pert_id<?php echo $i; ?>" value=<?php echo $pert['PPId']; ?>>
											</td>
										</tr>	
									 <?php
									}
								}
							?>
				   <tr role="rowgroup" id="row_0">
						<td data-label="" class="col_type">
						    <select disabled class=" w3-input w3-border w3-round" id="s_ctype0"  onblur="validate_type(0)">	
						       <option disabled>Select Type<option>
								<?php
									/*$contact_type = get_data("ctype_id,contact_type,active_mode,validation", "tbl_validations where active_mode>0 and Is_DC=1 order by ctype_id");
									while ($row = mysqli_fetch_array($contact_type)) {
										echo "<option data-ex='" . $row['Validation'] . "' data-active='" . $row['active_mode'] . "' value='" . $row['ctype_id'] . "'&quot;>" . $row['contact_type'] . "</option>";
									}*/
								?>
							</select>
						</td>
						<td data-label="Details" class="col_details">
							<input class=" w3-input w3-border w3-round" id="s_details0" onblur="validate(0)" value="">
						</td>
						<td data-label="Remark" class="col_remark">
						    <input class="w3-input w3-border w3-round" id="s_remark0" >
                       </td>
						<td>
							<a href="#" class="w3-text-green w3-hover-text-blue" style="padding: 5px 5px 5px 5px;" value="save" onclick="insert_row();" ><b><i class="fa fa-plus w3-border w3-padding-small w3-round w3-text-green"></i></b></a>
						</td>
				   </tr>
				<?php
					} else{
						$contact = get_data("ctype_id,contact_type,active_mode,validation", "tbl_validations where active_mode>0 and Is_DC=0 order by ctype_id ");
						if(isset($contact)){
							while ($c_row = mysqli_fetch_array($contact)) {
								$i++;
								$PPId = 0;
								$mode = 1;
								$details = "";
								$remark = "";
								if($c_row['active_mode'] == 1){
									$default = 1;
								} else{
									$default = 0;
								  }                           
//echo "*", "v_profilepert where empid=" . $_SESSION['employee_id'] . " and CTypId =" . $c_row['ctype_id'] . " order by CTypId";								  
								$contact_details = get_data("*", "v_profilepert where empid=" . $_SESSION['employee_id'] . " and CTypId =" . $c_row['ctype_id'] . " order by CTypId");
								if(isset($contact_details)){
									while ($pert = mysqli_fetch_array($contact_details)) {
										$PPId = $pert['PPId'];
										$mode = 2;
										$details = $pert['Value'];
										$remark = $pert['Remark'];
										$default = $pert['IsSE'];
									}
								}
								?>
								<tr role="rowgroup" id="row_<?php echo $i; ?>">
									<td data-label="GST No" class="col_type">
										<input class="w3-hide" id="s_mode<?php echo $i; ?>" value=<?php echo $mode; ?>>
										<input class="w3-hide" id="pert_id<?php echo $i; ?>" value=<?php echo $PPId; ?>>
										<select disabled class=" w3-input w3-border w3-round" id="s_ctype<?php echo $i; ?>"  onblur="validate_type(<?php echo $i; ?>)">	
											<option disabled>Select Type<option>
											<?php echo "<option selected data-ex='" . $c_row['validation'] . "' data-active='" . $c_row['active_mode'] . "' value=" . '"' . $c_row['ctype_id'] . '"' . "&quot;>" . $c_row['contact_type'] . "</option>";?>
										</select>
									</td>
									<td data-label="Details" class="col_details">
										<input class="w3-input w3-border w3-round" id="s_details<?php echo $i; ?>" <?php
										if($c_row['validation'] == 'datalist'){
											echo "list='emp_list'";
										}
										?> onblur="validate(<?php echo $i; ?>)" value="<?php echo $details; ?>">
									</td>
									<td class="w3-hide">
										<input type="checkbox" class="w3-check" style="top:0px" id="s_default<?php echo $i; ?>">
									</td>
									<td data-label="Remark" class="col_remark">
										<input class="w3-input w3-border w3-round" id="s_remark<?php echo $i; ?>" value="<?php echo $remark; ?>">
									</td>
						
								</tr>
								<?php
							}
						}
					}
					?>
				</tbody>
                </table>
            </div>
            <div class="w3-row-padding w3-margin-top">
                <button class="w3-btn w3-round w3-border w3-blue w3-right" onclick="save_pert()">Save <i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
 </body>
</html>