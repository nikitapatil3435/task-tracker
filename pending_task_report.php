<?php
require './dal/load_data.php';
include './dal/db.php';
require_once('tcpdf/tcpdf.php');

	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 9);  
      $obj_pdf->AddPage();  
      $content = '';	 
	$today_task=get_data("*","vw_task where due_date<'".date("Y-m-d")."' and is_complete=0 order by due_date DESC");
    $today=date("Y-m-d");
	$wrkid="Pending-Report";
	if(isset($today_task)){
      $content .= '<h3 align="center">Pending Task Report</h3><br><br/>  
      <table border="1" cellspacing="0"  cellpadding="5"  table id="Today-Task" width="100%">  
          <tr style="border:2px solid black;background-color:lightgrey;">
				<td width="15%"  align="center" style="height:10px"><b>Project Name</b></td>
				<td width="15%"  align="center" style="height:10px"><b>Module Name</b></td>
				<td width="15%"  align="center" style="height:10px"><b>Form Name</b></td>
				<td width="15%"  align="center" style="height:10px"><b>Task Description</b></td>
				<td width="15%"  align="center" style="height:10px"><b>Assigned To</b></td>
				<td width="15%"  align="center" style="height:10px"><b>Due Date</b></td>
				<td width="15%"  align="center" style="height:10px"><b>End Date</b></td>
				</tr>';
	while ($row1= mysqli_fetch_array($today_task)){  
      $content .= '<tr style="border:2px">';
		$content .= '<td width="15%" align="left"><style="text-align:left;height:10px" >'. $row1['project_name'] .'</td>';
		$content .= '<td width="15%" align="left"><style="text-align:left;height:10px" >'. $row1['module_name'] .'</td>';
		$content .= '<td width="15%" align="left"><style="text-align:left;height:10px" >'.$row1['form_name'].'</td>';
		$content .= '<td width="15%" align="left"><style="text-align:left;height:10px" >'.$row1['task_description'].'</td>';
		$content .= '<td width="15%" align="left"><style="text-align:left;height:10px" >'.$row1['first_name'].'</td>';
		$content .= '<td width="15%" align="left"><style="text-align:left;height:10px" >'.date('d-m-Y', strtotime($row1['due_date'])).'</td>';
		$content .= '<td width="15%" align="left"><style="text-align:left;height:10px" >'.date('d-m-Y', strtotime($row1['end_date'])).'</td>';
		$content .= '</tr>';
	}
		
		$content .= '</table>';  
	
       echo $content;
        $obj_pdf->writeHTML($content); 
	unlink(__DIR__ . '/daily_report/'.date('n',strtotime($today)).'_'.$wrkid.'.pdf');
        ob_end_clean(); 
        //$obj_pdf->Output(__DIR__ . '/daily_report/'.date('n').'_123.pdf', 'I');
        //$obj_pdf->Output(__DIR__ . '/daily_report/'.date('n').'_'.$wrkid.'.pdf', 'F');  
        $obj_pdf->Output(__DIR__ . '/daily_report/'.date('n',strtotime($today)).'_'.$wrkid.'.pdf', 'F'); 
	}
	else{
		
		echo '<script>alert("No data found")</script>' ; 
	}

?>
