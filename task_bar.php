<?php
        include 'header.php';
        require "dal/load_data.php";
       
        ?>
		<?php
$menu = 'Task Bar';
include 'menu.php';
?>
<html>
<head>
<script type="text/javascript">
function task_bar(){
	debugger;
	project_id=document.getElementById("project_name").value;
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_dashboard.php',
        data: {
                task_bar:'task_bar',
				project_id:project_id
			 },
        success: function (response)
		{  
            debugger;
			if(response >0){
			location.href="bar.php"
			}
            
		}   
    }); 
}	

</script>
</head>
<body>
<br><br>
			<div class="w3-col s12 l3 w3-row-padding">
			<label>Project Name</label>
			<select name="project_name" class="w3-input w3-border w3-round w3-padding-small" id="project_name" onchange="task_bar()">
		   <option value="">-- Select project Name--</option>
		   
			<?php
			
				$form_id=get_data("qut_id,project_name","tbl_quatation_master");	
				if (isset($form_id)) {
					while ($row = mysqli_fetch_array($form_id)) {
						
							echo "<option  class='w3-text-black' value=" . $row['qut_id'] . ">" . $row['project_name'] . "</option>";
						
					}
				}
			  ?>				  
		 </select>
		</div>				 
</body>
</html>