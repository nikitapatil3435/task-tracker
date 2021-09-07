<html>

<head>
    <?php
        include './header.php';
        require "dal/load_data.php";
       ?>
	   <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="js/report.js" type="text/javascript"></script>
		  <script type="text/javascript">
		  
		 $(document).ready(function() {
		 $.ajax
                ({
                  type: 'post',
                  url: 'dal/dal_report.php',
                  data: { 
                   fill_reportlist: 'fill_reportlist'
                  }, success: function (response) {
                    $("#filldata").append(response);
                  }
                });
				$('#tblreportdetails').DataTable({
					destroy: true,
					scrollX: true,
					scrollCollapse: true,
					paging: true,
				});
		});
		 </script>
   
</head>
<body>
    <div class="w3-container">
          <div class="w3-col s12 l12">
            <div class="w3-left w3-text-green w3-border-yellow w3-border-left w3-leftbar">
                <h4 style="font-family: Jaguar-Bold,SourceSansPro; text-transform: uppercase; margin-left: 10px"
                    class="w3-animate-left ">Report Details</h4>
               </div>
			</div> 
         <div class="w3-col s12 m12 l3 w3-right">
						<button type="button" name="submit" class="w3-button w3-blue w3-right"  onclick="clear_session()"><i class="fa fa-plus"
                           style="padding:5px;"></i>create project</button>
		</div>

</div>
        
      
         <br>
         <br>
		<div id="filldata">
		</div>
		</body>
</html>