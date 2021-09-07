<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'header.php';
        require "dal/load_data.php";
       
        ?>
  <style>
      .w3-input{padding:2px;}    
      div.dataTables_wrapper {
        margin: 0 auto;
      }
      div.container {
        width: 100%;
      }
      .pad2x{padding:2px;}
	  
    </style>

    
    <script src="jquery/dashboard.js" type="text/javascript"></script>
</head>
<body>
    
	
	<?php
	  $menu = 'Dashboard';
      include 'menu.php';
	?>
	<?php
		$get_today_tasks= get_data("*","vw_task where date(due_date)='".date("Y-m-d")."' and is_complete=0");
         if(isset($get_today_tasks)){
         $count_todays = mysqli_num_rows($get_today_tasks);}
		$get_pendind_task=get_data("*","vw_task where date(due_date)<'".date("Y-m-d")."' and is_complete=0");
         if(isset($get_pendind_task)){
         $count_pending=mysqli_num_rows($get_pendind_task);}	 
		$get_upcomming_task=get_data("*","vw_task where date(due_date)>'".date("Y-m-d")."' and is_complete=0");
         if(isset($get_upcomming_task)){
         $count_upcomming=mysqli_num_rows($get_upcomming_task);}	
		 $get_recent_task=get_data("*","vw_task where is_complete=1");
         if(isset($get_recent_task)){
         $count_recent=mysqli_num_rows($get_recent_task);}	
	?>
       <br>
       <br>
         <div class="w3-container">
		  				
		<div class="w3-col s12 m12 l3 w3-right">
						<button type="button" name="submit" class="w3-button w3-blue w3-right"  onclick="clear_session()"><i class="fa fa-plus"
                           style="padding:5px;"></i>create New Task</button>
		</div>
		<br>
		<br>
		<br>
		
		 <div id="task"class="w3-col l3"><button  class="w3-col w3-button w3-text-black w3-light-green w3-round-large " onclick="today_task_table()">
                <b>Todays Task</b>
				<label class="count_tag_1 w3-border w3-round-xlarge w3-pale-blue w3-padding-small w3-right"><?php if(isset($count_todays)){echo $count_todays;}else {echo 0 ;} ?></label></button>
		  </div>	
		<div class="w3-col l3"><button  class="w3-col w3-text-black w3-button w3-red w3-round-large " onclick="pending_task_table()">
                <b>Pending Task</b>
				<label class="count_tag_1 w3-border w3-round-xlarge w3-pale-blue w3-padding-small w3-right"><?php if(isset($count_pending)){echo $count_pending;}else {echo 0 ;} ?></label></button>
		  </div>
		<div class="w3-col l3"><button  class="w3-col w3-text-black w3-button w3-yellow w3-round-large " onclick="upcomming_task_table()">
                <b>Upcomming Task</b>
				<label class="count_tag_1 w3-border w3-round-xlarge w3-pale-blue w3-padding-small w3-right"><?php if(isset($count_upcomming)){echo $count_upcomming;}else {echo 0 ;} ?></label></button>
		  </div>
		<div class="w3-col l3"><button  class="w3-col w3-button w3-text-black w3-orange w3-round-large " onclick="recent_task_table()">
                <b>Recent Task</b>
				<label class="count_tag_1 w3-border w3-round-xlarge w3-pale-blue w3-padding-small w3-right"><?php if(isset($count_recent)){echo $count_recent;}else {echo 0 ;} ?></label></button>
		  </div>	
		
   
   </div>
   <br>
   <br>
   <div id="filldata"></div>
   </body>
</html>