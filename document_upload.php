<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include './header.php';
  require "dal/load_data.php";
?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="jquery/doc.js" type="text/javascript"></script>
  <style>
	.w3-input {
        padding: 2px;
		height:4vh;
    }

    .button {
        padding: 4px
    }

    a {
        padding: 4px;
    }

    tbody {
        display: block;
        overflow: auto;
        height: 405px;
    }

    thead,
    tbody tr {
        display: table;
        width: 100%;
    }

    table {
        width: 100%;
    }

    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {
        thead {
            width: calc(100% - 4px)
        }
    }
  </style>
   
</head>
<body>

<?php
$menu = 'Document Upload';
include 'menu.php';
?>
<?php
    $mode =1;
	if (isset($_SESSION['project_id']) && $_SESSION['project_id'] != "") {
		$project_id = $_SESSION['project_id'];
        $project_data = get_data("*", "tbl_project where project_id ='" . $project_id."'");
		if (isset($project_data)) {
	    while ($row = mysqli_fetch_array($project_data)) {
    	   $project_name= $row['project_name'];
		   
		   }
        }
    }
    ?>

<datalist id="project_list">

         <?php 
            
           $project = get_data("project_id,project_name", "tbl_project");
           if(isset($project)){
           while($project_list=mysqli_fetch_array($project))
           {
            
             echo "<option id =" .$project_list['project_id']. "  value = '".$project_list['project_name']. "'></option>";

            }
		   } 
       ?>
         </datalist>
		 
		 <datalist id="file_name_list">
				<?php
				 $get_list=get_data("file_name","tbl_project_document where project_id='".$project_id."'");
				 if(isset($get_list)){
				 while($doc_list=mysqli_fetch_array($get_list))
				 {
					echo "<option value = '".$doc_list['file_name']. "'></option>";
				 }
				 }
				?>
				</datalist>
		
	<div class="w3-container">	
      <form id="uploaddoc" action="" method="post"  enctype="multipart/form-data">	
				<div class="w3-row-padding">
				<div class="w3-left w3-text-black">
                <h3 style="font-family: Jaguar-Bold,SourceSansPro; text-transform: uppercase; margin-left: 10px"
                    class="w3-animate-left ">Document Upload</h3>                   
            </div>
			 </div>	<br>		
              <div class="w3-col s12 l3 w3-row-padding w3-margin-bottom">
					<label>Project Name</label>
					<input type="text" class="w3-input w3-border w3-round" name="project_id" id="project_id" list="project_list" onchange="create_table()" 
					value='<?php if(isset($_SESSION['project_id'])){ echo $project_name;}?>' autofocus> 
					
              </div>
			  <?php
			
			 if(isset($_SESSION['project_id']) && $_SESSION['project_id']!=""){
				 $project_id=$_SESSION['project_id'];
			 
			  ?>
			  <table class="w3-table" style="width:100%" id="doc_table<?php echo $project_id; ?>" role="row">
                 <thead>
				    <tr class="w3-blue-grey" role="row">
					  <th class="w3-col s12 l3 w3-center">File Type</th>
				      <th class="w3-col s12 l4 w3-center">File Name</th>
					  <th class="w3-col s12 l4 w3-center">Choose File</th>	
					  <th class="w3-col s12 l1 w3-right ">option</th>
                    </tr>
                </thead>
				<tbody role="rowgroup">
				
				<?php
				 $i=0;
				$document_data = get_data("*", "tbl_project_document where project_id ='" . $project_id."'");
					if(isset($document_data)){
					while($row = mysqli_fetch_array($document_data)) {
				     $f_id=$row['file_type_id'];
					$i++;
				 ?>
				<tr id="row<?php echo $project_id; ?>_<?php echo $i; ?>" role="row">
					<td data-label="File Type" class="w3-col s12 l3 w3-center">
					<select class="w3-select w3-border w3-round w3-padding-small" name="file_type_id" id="file_type_id<?php echo $project_id; ?>_<?php echo $i; ?>" disabled>
						<option disabled selected value="">Select File Type</option>
						 <?php
							$file_type=get_data("file_type_id,file_type_name","tbl_file_type_master");
							if(isset($file_type)){
								while($f_type = mysqli_fetch_array($file_type)){
									if($f_type['file_type_id']==$f_id && isset($f_id)){
											echo "<option class='' ' selected data-ref='" . $f_type['file_type_id'] . "'  value = " . $f_type['file_type_id'] . " >" . $f_type['file_type_name'] . " </option>";
									}else{
								           echo "<option class=''  value = " . $f_type['file_type_id'] . " >" . $f_type['file_type_name'] . " </option>";
								 }
							} 
						}
						?>
						</select>
					</td>
					<td data-label="File Name" class="w3-col s12 l4 w3-center "><?php echo $row['file_name']; ?></td>
					<td data-label="File" class="w3-col s12 l4 w3-center "><?php echo $row['file_path']; ?></td>
					
					
					 <td data-label="Option" class="w3-right w3-col s12 l1">
                    <a href="#" class="w3-ripple w3-text-red" onclick="delete_row('<?php echo $project_id; ?>_<?php echo $i; ?>')"><b><i class="fa fa-trash w3-large w3-center"></i></b></a>
                            <input class="w3-hide" id="mode<?php echo $project_id; ?>_<?php echo $i; ?>" value="2">
                            <input class="w3-hide" id="project_document_id<?php echo $project_id; ?>_<?php echo $i; ?>" value='<?php echo $row['project_document_id']; ?>'>
                      </td>

				</tr>
				<?php } }?>
				<tr id="row<?php echo $project_id; ?>_0" role="row">
					<td data-label="File Type" class="w3-col s12 l3 w3-center">
					<select class="w3-select w3-border w3-round w3-padding-small" name="file_type_id" id="file_type_id<?php echo $project_id; ?>_0" onchange="check_file('<?php echo $project_id; ?>_0')">
						<option disabled selected value="">Select File Type</option>
						 <?php
						$file_type=get_data("file_type_id,file_type_name","tbl_file_type_master");
						if(isset($file_type)){
							while($f_type = mysqli_fetch_array($file_type)){
							 echo "<option class=''  value = " . $f_type['file_type_id'] . " >" . $f_type['file_type_name'] . " </option>";
							 }
						}
						?>
						</select>
					</td>
					<td data-label="File Name" class="w3-col s12 l4 "><input type="text" class="w3-input w3-border w3-round" name="file_name" id="file_name<?php echo $project_id; ?>_0" list="file_name_list" onchange="check_file('<?php echo $project_id; ?>_0')"></td>
					<td data-label="File" class="w3-col s12 l3"><input type="file" class="w3-center w3-margin-left" name="img_upload" id="file_id<?php echo $project_id; ?>_0" ></td>
					<td data-label="Option" class="w3-col s12 l1 w3-left w3-right ">
					<button type="submit"><i class="fa fa-upload w3-text-blue w3-large w3-border"></i></button>
						<input id="project_row_id" class="w3-input w3-hide" value="<?php echo $project_id; ?>">
						<input id="project_document_id<?php echo $project_id; ?>_0" class="w3-input w3-hide" value="">
				        <input id="mode<?php echo $project_id; ?>_0" class="w3-input w3-hide" value="1">
					</td>
				</tr>
             </tbody>
			 </table> 
			 <?php } ?>
			<br>
			<br>
		</form>	
	</div>
			  
</body>
<html>
