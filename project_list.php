<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include './header.php';
        require "dal/load_data.php";
       
        ?>
  <style>
      .w3-input{padding:2px;
	  height:5vh;
	  }    
      div.dataTables_wrapper {
        margin: 0 auto;
      }
      div.container {
        width: 80%;
      }
	  label{
		font-family: 'Tangerine', serif;
		margin-top:5px;
		font-size:15px;
		
	}
      .pad2x{padding:2px;}
    </style>

    <script type="text/javascript">
    $(document).ready(function() {
		$.ajax
                ({
                  type: 'post',
                  url: 'dal/dal_project_details.php',
                  data: {
                    fill_projectlist: 'fill_projectlist'
                  }, success: function (response) {
                    $("#filldata").append(response);
                  }
                });
				$(document).ajaxStart(function () {
				  $("#imgLoading").show();
				}).ajaxStop(function () {
				  $("#imgLoading").hide();
					$('#tblprojectdetails').DataTable({
					destroy: true,
					scrollX: true,
					scrollCollapse: true,
					paging: true,
				});	
		});
    });
    </script>
    <script src="jquery/project_details.js" type="text/javascript"></script>
</head>
<body>

<?php
     //$menu = "Project";
    //include 'menu.php';
    $serverdate = date('m/d/y');
    $today = date("Y-m-d", strtotime($serverdate));
	  //$_SESSION['search_table']="";
?>
  <br>
  <br>
           <div class="w3-container">
        <div class="w3-col s12 l12">
            <div class="w3-left w3-text-black">
                <h4 style="font-family: Jaguar-Bold,SourceSansPro; text-transform: uppercase; margin-left: 10px"
                    class="w3-animate-left ">Project Details</h4>
                   
            </div>
			</div> 
		 <br>
		 <br>
		 <div class="w3-row-padding">
			<div class="w3-col s12 l3 w3-row-padding">
                    <label>From date</label>
                    <input type="date" class="w3-input w3-border w3-round" id="from_date" name="from_date" value="">
			</div>
		
			<div class="w3-col s12 l3 w3-row-padding">
                    <label>To date</label>
                    <input type="date" class="w3-input w3-border w3-round" id="To_date" name="To_date" value="">
			</div>
		
			<div class="w3-col s12 m12 l3 w3-margin-top">
						<button type="button" name="submit" class="w3-button w3-green w3-input w3-rightbar"  onclick="Generate_Excel()"><i class="fa fa-excel"
                           style="padding:5px;"></i>Generate Report +</button>
			</div>
			
			<div class="w3-col s12 m12 l3 w3-margin-top">
						<button type="button" name="submit" class="w3-button w3-blue w3-input"  onclick="clear_session()"><i class="fa fa-plus"
                           style="padding:5px;"></i>create project</button>
			</div>
		</div>
		<br>
		<br>
		
		<div id="filldata">
		</div>
		
		</div>
  
  </body>
</html>