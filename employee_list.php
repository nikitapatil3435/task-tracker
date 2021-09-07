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
        width: 80%;
      }
      .pad2x{padding:2px;}
    </style>

    <script type="text/javascript">
    $(document).ready(function() {
		$.ajax
                ({
                  type: 'post',
                  url: 'dal/dal_employee.php',
                  data: {
                    fill_employeelist: 'fill_employeelist'
                  }, success: function (response) {
                    $("#filldata").append(response);
                  }
                });
				$(document).ajaxStart(function () {
				  $("#imgLoading").show();
				}).ajaxStop(function () {
				  $("#imgLoading").hide();
					$('#tblemployeedetails').DataTable({
					destroy: true,
					scrollX: true,
					scrollCollapse: true,
					paging: true,
				});	
		});
    });
    </script>
    <script src="jquery/employee.js" type="text/javascript"></script>
</head>
<body>
    
	
	<?php
	  $menu = 'Employee';
      include 'menu.php';
		?>
       <br>
       <br>
         <div class="w3-container">
		   <div class="w3-left w3-text-black">
                <h4 style="font-family: Jaguar-Bold,SourceSansPro; text-transform: uppercase; margin-left: 10px"
                    class="w3-animate-left ">Employee Details  </h4>
		  </div>					
		<div class="w3-col s12 m12 l3 w3-right">
						<button type="button" name="submit" class="w3-button w3-blue w3-right"  onclick="clear_session()"><i class="fa fa-plus"
                           style="padding:5px;"></i>create employee</button>
		</div>
		<br>
		<br>
		<br>
		<div id="filldata"></div>
   
   </div>
   </body>
</html>