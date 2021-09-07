<!DOCTYPE html>
<html>
<head>
<?php
    include 'header.php';
	require "dal/load_data.php";
    ?>
<script src="jquery/loginpage.js"></script>
</head>
<body >
<div class="wrapper hover_collapse">
<?php

if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
$menu ='Role wise Rights';	
include 'menu.php';
$serverdate=date('m/d/y');
$today = date("Y-m-d", strtotime($serverdate));

$is_allowed=1;
if($is_allowed==1){
?>
		<div class="main_container">
			<h3 class="w3-margin-left">Role Wise Rights</h3>
			<div class="w3-padding w3-row">
				<div class="w3-row-padding w3-half">
					<select class="w3-select" id="user" autofocus onchange="get_menu()">
					<option selected disabled value="">Select Role</option>
					<?php
						$user = get_data("role_id,role","tbl_role");
						while($row=mysqli_fetch_array($user)){
							echo "<option value='".$row['role_id']."'>".$row['role']."</option>";	
						}
					?>	
					</select>
				</div>
			</div>
			<div class="w3-container w3-padding" id="user_rights">	
			</div>
		</div>
	</div>
	<footer class="w3-container w3-light-grey w3-bottom w3-padding">
		<span class="w3-left w3-margin-top">Developed By Integrate Infosolutions</span>
		<button class="w3-btn w3-black w3-right" onclick="save();">Save</button>
	</footer>
  <?php
	}else{
			echo '<script>alert("Page Forbidden")</script>';
	}
	}else{
		echo "<script>alert('Session Expired Please Log In Again')</script>";
		echo "<script>document.location.href='index.php'</script>";
	}
?>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function toggledropdown(drop) {
	//debugger;
	var dropdowns = document.getElementsByClassName("dropdown-content");
	var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
    document.getElementById(drop).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.btn')) {
		//alert(event.target)
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
	
</body>
</html>
