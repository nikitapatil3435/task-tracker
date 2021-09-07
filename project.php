<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include './header.php';
  require "dal/load_data.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/pro.js" type="text/javascript"></script>
<style>
#gif {
        z-index:9999999;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -50px 0px 0px -50px;
    }
</style>
</head>

<body>
 <?php
  
 
  $menu = 'Project';
include 'menu.php';
  
  ?>

	<br>
	<br>
 <?php
   
     // $_SESSION['employee_id']="";
	// $_SESSION['pro_id']="";
	 $mode=1;
	//echo $_SESSION['pid']="";
  if (isset($_SESSION['pid']) && $_SESSION['pid'] != "") {
	
       // $p_id = $_SESSION['pro_id'];
        //Master Details
  //  echo  "*", "tbl_project  where  project_id =" . $_SESSION['pid'];
	   $project = get_data("*", "tbl_project where project_id=" . $_SESSION['pid']);
       if (isset($project)){
            while ($row = mysqli_fetch_array($project)){
                $p_id=$row['project_id'];
				$p_name=$row['project_name'];
				$p_description=$row['project_description'];
				$p_sdate=date("Y-m-d", strtotime($row['project_start_date']));
				$project_complete_date=date("Y-m-d", strtotime($row['project_complete_date']));
				$p_kilometer=$row['kilometer'];
				$p_cost=$row['project_cost'];
				$amc_amout=$row['amc_amount'];
				$amc_date=$row['amc_date'];
				
				 }
	   }	  
    $mode=2;
  // echo "tbl_project= '" . $_SESSION['pro_id']."'";
   }
   
  ?>

<div class="w3-container">
        <div class="w3-col s12 l12">
            <div class="w3-left w3-text-green w3-border-yellow w3-border-left w3-leftbar">
                <h4 style="font-family: Jaguar-Bold,SourceSansPro; text-transform: uppercase; margin-left: 10px"
                    class="w3-animate-left ">Project Details  </h4>
                   
            </div>
			<br>
			
			
			 <div class="w3-col s12 m12 l3 w3-right">
						<button type="button" name="submit" class="w3-button w3-blue w3-right"  onclick="location.href='project_list.php';"><i class="fa fa-search"
                           style="padding:5px;"></i>search</button>
            <br>
        </div>
        </div> 
          <br>
        <!-- form -->
		
				<div class="w3-row-padding">
                <div class="w3-col s12 l4 w3-row-padding">
                    <label>Project Name </label>
                    <input type="text" class="w3-input w3-border" id="p_name" name="p_name" value="<?php if(isset($p_name)){ echo $p_name;} ?>" > 
					 <input class="w3-hide" id="p_id" value="<?php if(isset($p_id)){ echo $p_id;} ?>" >
					 <input class="w3-hide" id="today_date" value="">
					  <input class="w3-hide" id="mode" value="<?php if(isset($mode)){ echo $mode;} ?>">
					 </div>
				
				
             
				
				<div class="w3-col s12 l4 w3-row-padding">
					<label>Project Description</label>
					<input type="text" class="w3-input w3-border" id="p_description" name="p_description" value="<?php if(isset($p_description)){ echo $p_description;} ?>">
                </div>
				  
				  <div class="w3-col s12 l4 w3-row-padding">
                    <label>Project Start Date</label>
                    <input type="date" class="w3-input w3-border" id="p_startdate" name="p_startdate" value="<?php if(isset($p_sdate) && $p_sdate!="1970-01-01" && $p_sdate!="1900-01-01" ){ echo date("Y-m-d", strtotime($p_sdate));}?>">
                 </div>
				
				 </div>
				 
              <div class="w3-row-padding">
                   <div class="w3-col s12 l4 w3-row-padding">
                    <label>Project End Date</label>
                    <input type="date" class="w3-input w3-border" id="p_enddate" name="p_enddate" value="<?php if(isset($project_complete_date) && $project_complete_date!="1970-01-01" && $project_complete_date!="1900-01-01" ){ echo date("Y-m-d", strtotime($project_complete_date));}?>">
                 </div>
            
			     <div class="w3-col s12 l4 w3-row-padding">
                    <label>Kilometer</label>
                    <input type="text" class="w3-input w3-border w3-right-align " id="p_kilometer" name="p_kilometer" value="<?php if(isset($p_kilometer)){ echo $p_kilometer;} ?>" onkeypress="return validateFloatKeyPress(this, event, 18, -1);">
				</div>
				 
				 <div class="w3-col s12 l4 w3-row-padding">
                    <label>Project Cost</label>
                    <input type="text" class="w3-input w3-border w3-right-align" id="p_cost" name="p_cost" value="<?php if(isset($p_cost)){ echo $p_cost;} ?>" onkeypress="return validateFloatKeyPress(this, event, 18, -1);">
                 </div>
				 </div>
				 
				  <div class="w3-row-padding">
				  <div class="w3-col s12 l4 w3-row-padding">
                    <label>Project balance</label>
                    <input type="text" class="w3-input w3-border  w3-right-align" id="p_bal" name="p_bal" value="<?php if(isset($p_bal)){ echo $p_bal;} ?>" disabled >
                 </div>
				 
				 <div class="w3-col s12 l4 w3-row-padding">
                    <label>AMC Amount</label>
                    <input type="text" class="w3-input w3-border  w3-right-align" id="amc_amount" name="amc_amount" onkeypress="return validateFloatKeyPress(this, event, 18, -1);" value="<?php if(isset($amc_amout)){ echo $amc_amout;} ?>">
                 </div>
				 
				 <div class="w3-col s12 l4 w3-row-padding">
                    <label>AMC Date</label>
                    <input type="date" class="w3-input w3-border" id="amc_date" name="amc_date" value="<?php if(isset($amc_date) && $amc_date!="1970-01-01" && $amc_date!="1900-01-01" ){ echo date("Y-m-d", strtotime($amc_date));}?>">
                 </div>
				 
				 </div>
				 
				
				<div class="w3-row-padding w3-margin-top">
						<button type="button" name="submit" class="w3-button w3-blue w3-right" onclick="save_info()"><i class="fa fa-save"
                           style="padding:5px;"></i>Save</button>
						</div>
				
				<?php
				// echo $_SESSION['pid'];
				?>
</div>

<br>


	</body>
</html>