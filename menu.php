<?php
  $serverdate = date('m/d/y');
   $today = date("Y-m-d", strtotime($serverdate));
   if($_SESSION['user_id']==""){
     echo "<script>alert('Session Expired... Please log in again...')</script>";
     echo "<script>location.href = 'index.php'</script>";
   } 
?>
<!-- Navbar (sit on top) -->
<div class="w3-bar w3-card w3-text-white" id="myNavbar">
   <!-- Right-sided navbar links -->
   <!-- Hide right-floated links on small screens and replace them with a menu icon -->
   <div id='imgLoading' class="w3-overlay w3-text-aqua" onclick="w3_close()" style="cursor:pointer" id="myOverlay"><i id="gif" class="fa fa-spinner w3-spin" style="font-size:64px"></i></div>
    <div class="w3-row "style="background-color:#BC9E9E;">
		<div class="w3-col s10 l9">
			<a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-margin-right w3-margin-top" onclick="w3_open()">
			<i class="fa fa-bars w3-large"></i></a>
            <h3> <span class="w3-margin-left mmname">Task Tracker</span></h3>
		</div>
      <!--  <div class="w3-col s9 l9">
         <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-margin-right" onclick="w3_open()"><i class="fa fa-bars "></a> </i>
         <label class="w3-large w3-margin-left">Machine Maintenance</label>
         -->
		<div class="w3-col s2 l3">
			<span class="loginlogoutlink"><a  class="loginlogoutlink-login w3-right w3-margin-right w3-margin-top " href="index.php"><label class="w3-hide-small w3-medium w3-text-white"> Log Out </label><i class="fa fa-power-off w3-text-white w3-large"  title="Logout" aria-hidden="true"></i></a>
			</span>
        </div>
	</div>
   <!-- Sidebar on small screens when clicking the menu icon -->
    <nav class="w3-sidebar w3-bar-block w3-moss w3-card w3-dark-grey w3-animate-left" style="display:none;" id="menu">
      <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-large w3-padding">Close ×</a>
      <a href="rolewise_rights.php" data-menu="Role wise Rights" data-ref="" pref="1" class="w3-bar-item ">Role Wise Rights</a>
      <a href="dashboard.php" data-menu="Dashboard" data-ref="" pref="2" class="w3-bar-item" >Dashboard</a>
	  <a href="employee.php" data-menu="Employee" data-ref="" pref="3" class="w3-bar-item">Employee</a>
	  <a href="project.php" data-menu="Project" data-ref="" pref="4" class="w3-bar-item">Project</a>
      <a href="Document_upload.php" data-menu="Document Upload" data-ref="" pref="5" class="w3-bar-item">Document Upload</a>
      <a href="task.php" data-menu="Task Scheduling" data-ref="" pref="6" class="w3-bar-item" >Task Scheduling</a>
      <a href="report.php" data-menu="Daily Task Report" data-ref="" pref="7" class="w3-bar-item w3-border w3-border-blue w3-border-bottom">Daily Task Report</a>
      <a href="change_password.php" data-menu="change_password" data-ref="" pref="8" class="w3-bar-item w3-border w3-border-blue w3-border-bottom">change_password</a>
      <a href="task_bar.php" data-menu="Task Bar" data-ref="" pref="9" class="w3-bar-item w3-border w3-border-blue w3-border-bottom">Task Bar</a>
    </nav>
    <nav class="w3-sidebar w3-bar-block w3-moss w3-card w3-dark-grey w3-animate-left" style="display:none;" id="mySidebar">
      <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
      <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding">Close ×</a>
        <?php
         $menupages = get_data("menu_id,menu,menu_link,menu_text", "vw_rolewiserights where menu_ref='' and is_allowed=1 and role_id=" . $_SESSION['role_id'] . " order by pref");
         if (isset($menupages)) {
          while ($row = mysqli_fetch_array($menupages)) {
          $sub_menu = get_data("menu_id,menu,menu_link,menu_text", "vw_rolewiserights where menu_ref='" . $row['menu'] . "' and is_allowed=1 and role_id=" . $_SESSION['role_id']);
            if (isset($sub_menu)) {
              while ($row_1 = mysqli_fetch_array($sub_menu)) {
                echo '<a href="' . $row_1['menu_link'] . '" class="w3-bar-item w3-button">' . $row_1['menu'] . '</a><br>';
              }
            } else {
              echo '<a href="' . $row['menu_link'] . '" class="w3-bar-item w3-button">'. $row['menu'] . '</a><br>';
            }
          }
         }
        ?>
    </nav>
</div>
<?php
$is_allowed = 0;
$insert = 0;
$edit = 0;
$delete = 0;
$print = 0;
$approve = 0;
if (isset($_SESSION['role_id']))
{
    $rights = get_data("is_allowed,`insert`,`edit`,`delete`,`print`,`approve`", "vw_rolewiserights where menu='".$menu."' and role_id=" . $_SESSION['role_id']);
    if (isset($rights))
    {
        while ($row = mysqli_fetch_array($rights))
        {
            $is_allowed = $row['is_allowed'];
            $insert = $row['insert'];
            $edit = $row['edit'];
            $delete = $row['delete'];
            $print = $row['print'];
            $approve = $row['approve'];
        }
    }
}
if ($is_allowed == 0) {
  echo "<script>alert('Page Forbidden')</script>";
  echo "<script>location.href='index.php'</script>";
}
?>
<script>
   // Toggle between showing and hiding the sidebar when clicking the menu icon
   var mySidebar = document.getElementById("mySidebar");
   
   function w3_open() {
     if (mySidebar.style.display === 'block') {
       mySidebar.style.display = 'none';
     } else {
       mySidebar.style.display = 'block';
     }
   }   
   
   // Close the sidebar with the close button
   function w3_close() {
     mySidebar.style.display = "none";
     myOverlay.style.display = "none";
   //    document.getElementById("myOverlay").style.display = "none"; 
   // document.getElementById("mySidebar").style.display = "none";
   
   }
</script>