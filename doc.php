<?php
session_start();
include 'dal/db.php';
if(is_array($_FILES)){
	if(is_uploaded_file($_FILES['img_upload']['tmp_name'])){
		$sourcePath = $_FILES['img_upload']['tmp_name'];
		$targetPath = "uploads/".$_POST['project_id'] .'_'. $_FILES['img_upload']['name'];
		move_uploaded_file($sourcePath, $targetPath);
		echo $targetPath;
		//echo "Update tbl_project_document set file_path= '". $targetPath."' where project_document_id= " . $_SESSION['project_document_id'];
		mysqli_query($con, "Update tbl_project_document set file_path= '". $targetPath."' where project_document_id= " . $_SESSION['project_document_id']);
	}
}
?>
