<?php
require_once 'load_data.php';
session_start();
date_default_timezone_set("Asia/Calcutta");
include 'db.php';

if (isset($_POST['login'])) {
 //echo "emp_id,role,emp_name", "tbl_employee_detail where emp_name='" . $_POST['emp_name'] . "' and password='" . $_POST['password'] . "'");
 $login = get_data("empid,role,user,password", "tbl_employee_detail where user='" . $_POST['user_name'] . "' and password='" . $_POST['password'] . "'");
  if (isset($login)) {
    while ($row = mysqli_fetch_array($login)) {
      $_SESSION['user_id'] = $row['empid'];
      $_SESSION['username'] = $row['user'];
      $_SESSION['role_id'] = $row['role'];
      $_SESSION['password'] = $row['password'];
    }
    $defaultpage = get_data("menu_link", "vw_rolewiserights where is_default=1 and role_id=" . $_SESSION['role_id']);
    if (isset($defaultpage)) {
      while ($row_1 = mysqli_fetch_array($defaultpage)) {
        echo $row_1['menu_link'];
        $_SESSION['default_page'] = $row_1['menu_link'];
      }
    }
  } else {
    echo "incorrect";
  }
}

if(isset($_POST['change_password'])){
	
	mysqli_query($con, "update tbl_employee_detail SET password='$_POST[password]' where empid = ".$_SESSION['user_id']);
	exit();
}

if (isset($_POST['get_menu'])) {
  $output = "<table class='w3-table-all w3-hoverable' id='MyTable' style='margin-bottom:100px'>
		<tr class='w3-blue'>
		<th class='' style='width:36%'>Menu</th>
		<th style='width:8%'>Allow</th>
		<th style='width:8%'>Insert</th>
		<th style='width:8%'>Edit</th>
		<th style='width:8%'>Delete</th>
		<th style='width:8%'>Search</th>
		<th style='width:8%'>Print</th>
		<th style='width:8%'>Approve</th>
		<th style='width:8%'>Default</th>
		</tr>";
  $menu_list = explode(',', $_POST['items']);
  $links = explode(',', $_POST['links']);
  $ref = explode(',', $_POST['ref']);
  $menu_text = explode(',', $_POST['menu_text']);
  $pref = explode(',', $_POST['pref']);
  $id = 1;
  $i = 0;
  foreach ($menu_list as $menu) {
    if ($menu != "") {
      $output = $output . "<tr>
				<td class='' style='width:36%' id='menuname" . $id . "'>" . $menu . "</td>
				<td class='w3-hide' id='menu_link" . $id . "'>" . $links[$i] . "</td>
				<td class='w3-hide' id='menu_ref" . $id . "'>" . $ref[$i] . "</td>
				<td class='w3-hide' id='menu_text" . $id . "'>" . $menu_text[$i] . "</td>
				<td class='w3-hide' id='pref" . $id . "'>" . $pref[$i] . "</td>
				";
      $present = get_data("is_allowed,`insert`,`edit`,`delete`,`search`,`print`,`approve`,is_default", "vw_rolewiserights where role_id=" . $_POST['user_id'] . " and menu = '" . $menu . "'");
      if (isset($present)) {
        while ($row = mysqli_fetch_array($present)) {
          if ($row['is_allowed'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='is_allowed" . $id . "' onchange = 'toggle_check(" . $id . ")' checked></td>";
          } else {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='is_allowed" . $id . "' onchange = 'toggle_check(" . $id . ")'></td>";
          }
          if ($row['insert'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='insert" . $id . "' checked></td>";
          } else if ($row['is_allowed'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='insert" . $id . "' ></td>";
          } else {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='insert" . $id . "' disabled ></td>";
          }
          if ($row['edit'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='edit" . $id . "' checked></td>";
          } else if ($row['is_allowed'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='edit" . $id . "' ></td>";
          } else {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='edit" . $id . "' disabled></td>";
          }
          if ($row['delete'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='delete" . $id . "' checked></td>";
          } else if ($row['is_allowed'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='delete" . $id . "' ></td>";
          } else {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='delete" . $id . "' disabled></td>";
          }
          if ($row['search'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='search" . $id . "' checked></td>";
          } else if ($row['is_allowed'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='search" . $id . "' ></td>";
          } else {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='search" . $id . "' disabled></td>";
          }
          if ($row['print'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='print" . $id . "' checked></td>";
          } else if ($row['is_allowed'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='print" . $id . "' ></td>";
          } else {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='print" . $id . "' disabled></td>";
          }
          if ($row['approve'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='approve" . $id . "' checked></td>";
          } else if ($row['is_allowed'] == 1) {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='approve" . $id . "' ></td>";
          } else {
            $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check'  id='approve" . $id . "' disabled></td>";
          }
          if ($row['is_default'] == 1) {
            $output = $output . "<td style='width:8%'><input type='radio' name='isdefault' class='w3-check' id='default" . $id . "' checked></td>";
          } else if ($row['is_allowed'] == 1) {
            $output = $output . "<td style='width:8%'><input type='radio' name='isdefault' class='w3-check' id='default" . $id . "'></td>";
          } else {
            $output = $output . "<td style='width:8%'><input type='radio' name='isdefault' class='w3-check' id='default" . $id . "' disabled></td>";
          }
        }
      } else {
        $output = $output . "<td style='width:8%'><input type='checkbox' class='w3-check' id='is_allowed" . $id . "' onchange = 'toggle_check(" . $id . ")'></td>
					<td style='width:8%'><input type='checkbox' class='w3-check' disabled id='insert" . $id . "' ></td>
					<td style='width:8%'><input type='checkbox' class='w3-check' disabled id='edit" . $id . "' ></td>
					<td style='width:8%'><input type='checkbox' class='w3-check' disabled id='delete" . $id . "' ></td>
					<td style='width:8%'><input type='checkbox' class='w3-check' disabled id='search" . $id . "' ></td>
					<td style='width:8%'><input type='checkbox' class='w3-check' disabled id='print" . $id . "' ></td>
					<td style='width:8%'><input type='checkbox' class='w3-check' disabled id='approve" . $id . "' ></td>
					<td style='width:8%'><input type='radio' name='isdefault' class='w3-check' disabled id='default" . $id . "'></td>";
      }
      $output = $output . "</tr>";
    }
    $i++;
    $id++;
  }
  $output = $output . "</table><input class='w3-hide' value=" . $id . " id='row_no'>";
  echo $output;
}

if (isset($_POST['save_details'])) {
  $adduserdate = date('Y-m-d h:m:s');
  $_POST['menu_text'] = mysqli_real_escape_string($con, $_POST['menu_text']);
  echo "call rolewiserights('$_POST[user_id]','$_POST[menu]','$_POST[menu_link]','$_POST[menu_ref]','$_POST[menu_text]',$_POST[pref],'$_POST[is_allowed]','$_POST[isinsert]','$_POST[isedit]','$_POST[isdelete]','$_POST[issearch]','$_POST[isprint]','$_POST[isapprove]','$_POST[is_default]',0,'$adduserdate',1)";
  mysqli_query($con, "call rolewiserights('$_POST[user_id]','$_POST[menu]','$_POST[menu_link]','$_POST[menu_ref]','$_POST[menu_text]',$_POST[pref],'$_POST[is_allowed]','$_POST[isinsert]','$_POST[isedit]','$_POST[isdelete]','$_POST[issearch]','$_POST[isprint]','$_POST[isapprove]','$_POST[is_default]',0,'$adduserdate',1)");
  exit();
}
if (isset($_POST['delete_setting'])) {
  mysqli_query($con, "delete from tbl_rolewiserights where role_id=" . $_POST['user_id']);
  exit();
}
?>