<html>
<head>
<?php
      include './header.php';
      require 'dal/load_data.php';

      ?>
    <script src="jquery/main_report.js"></script>

<style>
.w3-input {
        padding: 2px;
    }

    .button {
        padding: 4px
    }

    tbody {
        display: block;
        overflow: auto;
    }

    thead,
    tbody tr {
        display: table;
        width: 100%;
        /*table-layout:fixed;*/
    }

    thead {
        width: calc(100% - 1em)
    }

    table {
        width: 100%;
    }
</style>
</head>
<body>
<?php
$menu = 'reports';
    include './menu.php';

?>

<div class="w3-container">
    <div "w3-row-padding">
            <div class="w3-col l3 s12">

    <h5 class="w3-padding w3-border-bottom" style="width:100%;"><i class="fa fa-wpforms"></i> Reports</h5>

                <label>Type of Report</label>
      <select id="report_name" class="w3-input text-rufblue w3-border" type="text" onclick="show_crieteria()">
                    <option>Choose Type Of Report</option>
                    <option value="1">Complete task</option>
                    <option value="2">Incomplete task</option>
                    <option value="3">Inprogress task</option>
                    <option value="4">Ticket Generation</option>
  </select>
     <div>
</div>
</div>
<div class="w3-row-padding " style="display:none" id="tcs_amt_report">
			
        <div class="w3-padding">
            <button class="w3-right w3-black w3-button w3-margin-left" id="btn_report" onclick="execute_report()"
               ><i class="fa fa-file-excel-o"></i>
                Excel</button>
            <button class="w3-right w3-black w3-button" id="btn_pdf" onclick="show_report()" style="display:none"><i
                    class="fa fa-file-pdf-o"></i>Pdf</button>
        </div>
		</div>

        </div>
</body>
</html>