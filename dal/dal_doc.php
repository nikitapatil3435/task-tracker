<?php
session_start();
include 'db.php';
include 'load_data.php';
if(isset($_POST['get_save'])) 
{
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['project_document_id']);
    //echo "call project_document(@id,'$_POST[project_id]','$_POST[file_type_id]','$_POST[file_name]','$_POST[file_id]','1','$adduserdate','$_POST[mode]')";
	$query = mysqli_query($con,"call project_document(@id,'$_POST[project_id]','$_POST[file_type_id]','$_POST[file_name]','$_POST[file_id]','1','$adduserdate','$_POST[mode]')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
	$_SESSION['project_document_id'] = $row['@id'];
    echo $row['@id'];
	if (!file_exists('../directory/'.$_POST['file_name'])) {
			mkdir('../directory/'.$_POST['file_name'], 0777, true);
	}
	exit();
}
if(isset($_POST['create_table'])) 
{
	$_SESSION['project_id'] = $_POST['pro_id'];
}
if(isset($_POST['get_delete_pert'])) 
{
	$adduserdate = date('Y-m-d h:m:s');
	mysqli_query($con, "set @id = " . $_POST['id']);
	//echo "call project_document(@id,'0','0','0','0','1','$adduserdate','3')";
	$query = mysqli_query($con,"call project_document(@id,'0','0','0','0','1','$adduserdate','3')");
	$result = mysqli_query($con, "SELECT @id");
	$row = mysqli_fetch_assoc($result);
}
if(isset($_POST['check_file']))
{     //echo "file_type_id,file_name,project_id","tbl_project_document where file_type_id='" . $_POST['file_type_id'] . "' and file_name='" . $_POST['file_name'] . "' and project_id='" . $_POST['project_id'] . "'";
     $check =get_data("file_type_id,file_name,project_id","tbl_project_document where file_type_id='" . $_POST['file_type_id'] . "' and file_name='" . $_POST['file_name'] . "' and project_id='" . $_POST['project_id'] . "'");
	 if(isset($check)){
		 echo 1;
	 }
   
}	