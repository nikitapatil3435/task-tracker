<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <?php
        include './header.php';

    ?>
                       <style>
    #gif {
                position: absolute;
                top: 50%;
                left: 50%;
                margin: -50px 0px 0px -50px;
            }
.login-w3layout{
	background:linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5)), url(img/download.png)no-repeat 0px 0px;
	background-size: cover;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	-ms-background-size: cover;
	background-attachment: fixed;
	min-height: 655px;
	/* position: relative; */
  z-index:1;
}

.w3ls_schedule_bottom_right_grid {
	/* padding: 2em; */
	background: rgba(0, 0, 0, 0.50);
	/* background: rgba(231, 242, 156, 0.68); */
	width: 100%;
	/* margin: 0 auto; */
	opacity: 10;
}
    </style>
                        <script type="text/javascript">
                            /* send monthly report */
                            $(document).ready(function () {
                                $(document).ajaxStart(function () {
                                    debugger;
                                    $("#imgLoading").show();
                                }).ajaxStop(function () {
                                    debugger;
                                    $("#imgLoading").hide();
                                });
                            });
                            function change_password() {
                                debugger;
                                var c_password = document.getElementById('c_password').value;
                                var password = document.getElementById('password').value;
								if(password==""){
									alert("Please provide password");
									document.getElementById('password').focus();
									return;
								}
								if(password != c_password){
									alert("Password and Confirm Password do not match");
									return;
								}
                                $.ajax
                                        ({
                                            type: 'post',
                                            url: 'dal/dal_usersetting.php',
                                            data: {
                                                change_password: 'change_password',
                                                password: password,
                                            },
                                            success: function (response) {
                                                debugger;
													alert("Password changed successfully");
                                                    document.location.href = "report.php";
                                            }
                                        })
                            }
                        </script>
                        </head>
                        <body>
                              <?php
                                  
                              require_once 'dal/load_data.php';
                              ?>
							  <div class="login-w3layout">
                              <div id='imgLoading' class="w3-overlay" style=''><i id="gif" class="fa fa-spinner w3-spin" style="font-size:64px"></i></div>
							   <div id='imgLoading' class="w3-overlay w3-text-aqua"><i id="gif" class="fa fa-spinner w3-spin" style="font-size:64px"></i></div>
								<div class="w3-container  w3-col l3 m8 s12  w3-display-middle w3-padding w3ls_schedule_bottom_right_grid ">
							    <div class="w3-center w3-text-white ">
											<h4 style="font-family: Jaguar-Bold,SourceSansPro; text-transform: uppercase"
												class="w3-animate-left ">Change Password</h4>
											   
										</div>
			
                                <div class=" w3-padding-8 ">
                                    <form class="w3-margin w3-padding w3-text-white" method="post">
                                        <div class="w3-row w3-section">
                                            <div class="w3-col w3-text-white" style="width:50px"><i class="w3-xlarge fa fa-asterisk"></i></div>
                                            <div class="w3-rest">
                                                <input class="w3-input w3-white" type="password" id="password" name="password" placeholder="Password" autofocus required/>
                                            </div>
                                        </div>

                                        <div class="w3-row w3-section">
                                            <div class="w3-col w3-text-white" style="width:50px"><i class="w3-xlarge fa fa-asterisk"></i></div>
                                            <div class="w3-rest">
                                                <input class="w3-input w3-white" type="password" id="c_password" name="c_password" placeholder="Confirm Password" required/>
                                            </div>
                                        </div>
										
                                        <p class="w3-center">
                                            <button class="w3-button w3-section w3-white w3-ripple" type="button" onclick="change_password();"> Submit </button><br>
                                        </p>	
                                    </form>
                                </div>
                            </div>
							</div>
                        </body>
                        </html>


