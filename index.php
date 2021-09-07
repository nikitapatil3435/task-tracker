<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title> Login Page </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"> </script>
		<link href="css/datatable.css" rel="stylesheet" type="text/css"/>
		<link href="css/responsivetables.css" rel="stylesheet" type="text/css"/>
		<script src="plugins/jquery.dataTables.min.js" type="text/javascript"></script>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
		
		<style>
			.img{
				background:url('image/loginpage9.jpg');
				background-repeat: no-repeat;
			}
			.h2{
				 margin-left:20px;
				 margin-top:20px;
				 font-family: 'Tangerine', serif;
				  font-size: 48px;
				  text-shadow: 4px 4px 4px #aaa;
				 
			}
			.font{
				 font-family: 'Tangerine', serif;
				 text-shadow: 4px 4px 4px #aaa;
			}
			.fontSize{
				font-size:30px;
			}
			
		</style>
		<script>
			function login() {
                debugger;
                var user_name = document.getElementById('user_name').value;
                var password = document.getElementById('password').value;

               if (user_name != "") {
                var emp_id = $('#employeelist option[value="' + user_name + '"]').attr('id');
                if (emp_id == undefined) {
			        alert("Please select valid employee  from the list");
			        document.getElementById("user_name").value = "";
			        document.getElementById("user_name").focus();
						return;
					}

				} else {
					alert("Please select employee from the list");
					document.getElementById("user_name").focus();
					return;
				}             
                   
                 if (password == "")
                {
                    alert('Please select password');
                    document.getElementById('password').focus();
                    return;
                }    
                $.ajax
                        ({
                            type: 'post',
                            url: 'dal/dal_loginpage.php',
                            data: {
                                login:'login',
                                user_name:user_name,
                                password:password,
                            },
                            success: function (response) {                                 
                                debugger;
								//email(); //parallaly execute login & email function & go to line 178
                                if (response == 'incorrect') {
                                    alert("Please provide valid user name and password");
                                } else {
                                    document.location.href=response;				
                                }
								
                            }
                        })
            }
		</script>
		
	</head>
	<body>
	<?php
session_unset();
session_destroy();
require_once 'dal/load_data.php';
?>
<div class="w3-row-padding">

	<div class="w3-col s12 m12 l7 w3-hide-small">
		<img src="image/undraw_co-working_825n.png"style="width:100%;">
	</div>
	<div class="w3-col s12 m12 l5">
		<h2 class=" h2 w3-display-top w3-text-blue ">Integrate InfoSolutions</h2>
		
		<div class="w3-container w3-card-12 w3-col s12 m12 l12  w3-display-middle-left w3-padding">		
					 
			<div class=" w3-padding-8 ">
				<h3 class="w3-center">				
                     <br><b id="land_page" name="land_page" class=" font fontSize w3-center w3-text-black " >Login</b>
                </h3>							
				<div class="w3-row w3-section">
					<div class="w3-col w3-text-blue" style="width:50px"><i class="w3-xlarge fa fa-user"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input " type="text" id="user_name" name="user_name" list="employeelist" placeholder="Username" required autofocus />
						<datalist id="employeelist">
					 <?php 
				   
					   $employee = get_data("empid,user", "tbl_employee_detail");
					   if(isset($employee))
					   while($employee_list=mysqli_fetch_array($employee))
					   {
						
						 echo "<option id =" .$employee_list['empid']. "  value = '".$employee_list['user']. "' ></option>";

						}
					   
				   ?>
			         </datalist>	
					</div>
                </div>
				<div class="w3-row w3-section">
                    <div class="w3-col w3-text-blue" style="width:50px"><i class="w3-xlarge fa fa-asterisk"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input " type="password" id="password" name="password" placeholder="Password" required />
                    </div>
                </div>
				<p class="w3-center">
					<button id="loginbtn" class=" font w3-button w3-section w3-blue w3-ripple w3-round-xxlarge" type="button" onclick="login()"style="width:40%"> Login <i class="fa fa-sign-in"></i> </button><br>
			    </p>
				<p class="w3-center">
					<a href="#" class="font w3-right w3-text-red">Forgot Password</a>
			   </p>
			</div>			
		</div>
	</div>
</div>

</body>
</html>