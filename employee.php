<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include 'header.php';
  require "dal/load_data.php";
?>

    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/responsivetables.css">
    <script src="jquery/employee.js" type="text/javascript"></script>
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
  $menu = 'Employee';
  include 'menu.php';
  ?>  
  <?php
     //  $_SESSION['employee_id']="";
	 $mode=1;
    if (isset($_SESSION['employee_id']) && $_SESSION['employee_id'] != "") {// get edit session
        $emp_id = $_SESSION['employee_id'];
        //Master Details
       //echo  "*", "tbl_employee_details where EmpId =" . $_SESSION['employee_id'];
	   $employeedetails = get_data("*", "tbl_employee_detail where empid =" . $_SESSION['employee_id']); //get id using where clause
       if (isset($employeedetails )) {//confirm that this variable is exist or not
            while ($row = mysqli_fetch_array($employeedetails)) {//check for each row
                $emp_id=$row['empid'];// set values  variablenm -> $emp_id=$row['empid'] <- database field
                $first_name=$row['first_name'];
                $middle_name=$row['middle_name'];
                $last_name=$row['last_name'];
                $joinning_date = date("Y-m-d", strtotime($row['joinging_date']));
			    $left_date =date("Y-m-d", strtotime($row['left_date']));
                $address = $row['address'];
                $reporting_authority = $row['reporting_authority'];
                $employee_role = $row['employee_role'];				
                $email = $row['email'];			   
			    $gender=$row['gender'];               
			    $is_team_lead=$row['is_team_lead'];               
			    $user=$row['user'];               
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
                    class="w3-animate-left ">Employee</h3>
            </div>
            <div class="w3-col s12 m12 l3 w3-right">
				<button type="button" name="submit" class="w3-button w3-blue w3-right w3-margin-top w3-margin-right"  onclick="location.href='employee_list.php';"><i class="fa fa-search"
                style="padding:5px;"></i>Search</button>
            <br>
            </div>
        <br>
        <!-- form -->
        <form action="" method="post">
				<div class="w3-row-padding w3-margin-top">
					  <div class="w3-col s11 l3 w3-row-padding">
						<input class="w3-hide" id="emp_id" value="<?php if(isset($emp_id)){ echo $emp_id;} else{ echo '0';} ?>">
						<input class="w3-hide" id="mode" value="<?php if(isset($mode)){ echo $mode;} ?>">
						<label>First Name</label>
						<input type="text" class="w3-input w3-border w3-round" id="first_name" name="first_name" value="<?php if(isset($first_name)){ echo $first_name;} ?>"> 
						</div>
					  <div class="w3-col s12 l3 w3-row-padding">
						<label>Middle Name</label>
						<input type="text" class="w3-input w3-border w3-round" id="middle_name" name="middle_name" value="<?php if(isset($middle_name)){ echo $middle_name;} ?>">
					 </div>
					 <div class="w3-col s12 l3 w3-row-padding">
						<label>Last Name</label>
						<input type="text" class="w3-input w3-border w3-round" id="last_name" name="last_name" value="<?php if(isset($last_name)){ echo $last_name;} ?>">
					 </div>
					<div class="w3-col s12 l3 w3-row-padding">
						<label>Employee Address</label>
						<input type="text" class="w3-input w3-border w3-round" id="emp_address" name="emp_address" value="<?php if(isset($address)){ echo $address;} ?>">
					 </div>				 
				    <div class="w3-col s12 l3 w3-row-padding">
						<label>Employee Joinning Date</label>
						<input type="date" class="w3-input w3-border w3-round"  id="joining_date" name="joining_date" value="<?php if(isset($joinning_date)){ echo $joinning_date;} ?>">
					 </div>
					 <div class="w3-col s12 l3 w3-row-padding">
						<label>Employee Left Date</label>
						<input type="date" class="w3-input w3-border w3-round"  id="left_date" name="left_date" value="<?php if(isset($left_date)){ echo $left_date;} ?>">
                    </div>				 
					 <div class="w3-col s12 l3 w3-row-padding">
						<label>Employee Role</label>
						<select class="w3-input w3-border w3-round" style="padding:0px;margin=0px;"  name="employee_role" id="employee_role">
						<option disabled selected value="">Select Employee Role</option>
						<?php
							$e_role = get_data("role_id,role","tbl_role");
							if (isset($e_role)) {
								while ($emp_role = mysqli_fetch_array($e_role)) {
									if($emp_role['role_id']==$employee_role && isset($employee_role)){
									echo "<option class='' ' selected data-ref='" . $emp_role['role_id'] . "'  value = " . $emp_role['role_id'] . " >" . $emp_role['role'] . " </option>";
									}else{	
									echo "<option class=''  value = " . $emp_role['role_id'] . " >" . $emp_role['role'] . " </option>";
									}
								} 
							}
						?>
						</select>
					 </div>				 
					<div class="w3-col s11 l3 w3-row-padding">
						<label>Employee Email</label>
						<input type="email" class="w3-input w3-border w3-round" id="email" name="email" value="<?php if(isset($email)){ echo $email;} ?>"> 
					</div>	
                    <div class="w3-col s12 l3 w3-row-padding">
						<label>Reporting Authority</label>
						<select class="w3-input w3-border w3-round" style="padding:0px;margin=0px;"  name="reporting_authority" id="reporting_authority">
							<option disabled selected value="">Select Reporting Authority</option>
							<?php
							   $emp_authority = get_data("empid,first_name", "tbl_employee_detail");
							   if(isset($emp_authority)){
							   while ($row1 = mysqli_fetch_array($emp_authority))
								if($row1['empid']==$reporting_authority && isset($reporting_authority)){
									echo "<option class='' ' selected data-ref='" . $row1['empid'] . "'  value = " . $row1['empid'] . " >" . $row1['first_name'] . " </option>";
								}else{								
								   echo "<option value='" . $row1['empid'] . "'>" . $row1['first_name'] . "</option>";
								}
							   }
							?>
							
						</select>
					</div>						
					<div class="w3-col s12 l3 w3-row-padding">
						<label>Employee Gender</label><br>
						<input type="radio" id="male" name="gender" value="male"<?php if(isset($gender)){echo ($gender=="male")?'checked':'true';}?>>
						  <label for="male">Male</label>
						  <input type="radio" id="female" name="gender" value="female"<?php if(isset($gender)){echo ($gender=="female")?'checked':'true';}?>>
						  <label for="female">Female</label><br>
					</div>
					<div class="w3-col l3">  
                           <label>Is Team Lead</label>					
						  <input type="checkbox" class="w3-check w3-large w3-margin-top w3-padding-small w3-round" style="text-align:right" id="is_team_lead" name="is_team_lead" value='<?php if(isset($is_team_lead)){echo $is_team_lead;}?>' <?php if(isset($is_team_lead)){echo ($is_team_lead==1)?'checked':'true';}?>>
					 </div>	
					 <div class="w3-col s12 l3 w3-row-padding">
						<label>Create User Name</label>
						<input type="text" class="w3-input w3-border w3-round" id="user_name" name="user_name" value="<?php if(isset($user)){ echo $user;} ?>">
					 </div>
                </div>					 
				 <br>
				 <br>			
				 <table class="w3-hide"style="width:100%" role='row' id="pert_table">
            <thead>
                <tr role='row' class="">

                    <th scope="col" class="w3-col s12 m12 l4">Employee From Date</th>
                    <th scope="col" class="w3-col s12 m12 l4">Employee To Date</th>
                    <th scope="col" class="w3-col s12 m12 l3">Employee Rate Per Minute</th>
                    <th scope="col" class="w3-col s12 m12 l1"></th>
                </tr>
            </thead>
            <tbody role='rowgroup'>
			<?php
			$i=0;
			if(isset($pert)){
				while($pertrow = mysqli_fetch_array($pert)){
					$i++;
			?>
			 <tr role=" row" id="row<?php echo $i;?>">
                    <td data-label="Employee From Date" class="w3-col s12 m12 l4">
                      <input type="date" class="w3-input w3-border" id="emp_fdate<?php echo $i;?>" name="emp_date"
					  value='<?php echo $pertrow['from_date']; ?>'>
                      </td>      
					
                    <td data-label="Employee To Date" class="w3-col s12 m12 l4">
                        <input type="date" class="w3-input w3-border " id="emp_tdate<?php echo $i;?>" name="emp_ldate0"
						value='<?php echo $pertrow['to_date']; ?>'>
                         
                    </td>
                    <td data-label="Employee Rate Per Minute" class="w3-col s12 m12 l3">
                        <input type="text" class="w3-input w3-border w3-right-align" id="emp_min<?php echo $i;?>" name="emp_min0"
                            onkeypress="return validateFloatKeyPress(this, event, 18, 1);"
                            style="text-align: right;" value='<?php echo $pertrow['rate']; ?>'>
                    </td>
                    
                    <td data-label="Option" class="w3-col s12 m12 l1">
                    <a href="#" class="w3-ripple w3-text-red" onclick="delete_row(<?php echo $i;?>)"><b><i class="fa fa-trash w3-large"></i></b></a>
                            <input class="w3-hide" id="mode<?php echo $i;?>" value="2">
                            <input class="w3-hide" id="emp_pert_id<?php echo $i;?>" value='<?php echo $pertrow['emp_pert_id']; ?>'>
                        </td>
                </tr>
			<?php
			  }
			} ?>
            <tr role=" row" id="row0">
                    <td data-label="Employee From Date" class="w3-col s12 m12 l4">
                      <input type="date" class="w3-input w3-border" id="emp_fdate0" name="emp_fdate0" onchange="check_date(0)">
                      </td>      
					
                    <td data-label="Employee To Date" class="w3-col s12 m12 l4">
                        <input type="date" class="w3-input w3-border " id="emp_tdate0" name="emp_tdate0">
                         
                    </td>
                    <td data-label="Employee Rate Per Minute" class="w3-col s12 m12 l3">
                        <input type="text" class="w3-input w3-border w3-right-align" id="emp_min0" name="emp_min0"
                            onkeypress="return validateFloatKeyPress(this, event, 18, 1);"
                            style="text-align: right;">
                    </td>
                    
                    <td data-label="Option" class="w3-col s12 m12 l1" >
                    <a href="#" class="w3-ripple w3-text-green" onclick="insert_row(0)"><b><i class="fa fa-plus w3-large"></i></b></a>
                            <input class="w3-hide" id="mode0" value="1">
                            <input class="w3-hide" id="emp_pert_id0" value="0">
                        </td>
            </tr>             
            </tbody>				 
				</table> 
				<br>
				<br>            
			    <div class="w3-row-padding">               
					<div class="w3-col s13 m13 l30">
						<button type="button" name="submit" class="w3-button w3-blue w3-right"  onclick="save_emp()"><i class="fa fa-save"
							   style="padding:5px;"></i>Proceed to Contact Details</button>
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
       
			