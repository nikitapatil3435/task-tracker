<!DOCTYPE html>
<html>
<head>
<?php
  include 'header.php';
  require "dal/load_data.php";
?>

 <link rel="stylesheet" href="css/responsivetables.css">
    <script src="jquery/demo.js" type="text/javascript"></script>
	</head>
	<body>
	 <div class="w3-col s12 l3 w3-row-padding">
						<label>Country Name</label>
						<select name="country_name" class="w3-input w3-border w3-round w3-padding-small" id="country_name" onchange="load_state()">
					   <option value="">-- Select Country Name--</option>
						<?php
							$country_id=get_data("country_id,country_name","tbl_country");	
							if (isset($country_id)) {
								while ($row = mysqli_fetch_array($country_id)) {
									
										echo "<option  class='w3-text-black' value=" . $row['country_id'] . " data-value='1'>" . $row['country_name'] . "</option>";
									
								}
							}
						  ?>				  
		                </select>
	 </div>
	 <div class="w3-col s12 l3 w3-row-padding">
						<label>State Name</label>
						<select name="state_name" class="w3-input w3-border w3-round w3-padding-small" id="state_name" onchange="load_city()">
					   <option value="">-- Select state Name--</option>
						<?php
							$state_id=get_data("state_id,state_name","tbl_state");	
							if (isset($state_id)) {
								while ($row = mysqli_fetch_array($state_id))  {
										echo "<option  class='w3-text-black' value=" . $row[''] . ">" . $row[''] . "</option>";
									}
								}
							
						  ?>				  
		                </select>
	 </div>
	 <div class="w3-col s12 l3 w3-row-padding">
						<label>city Name</label>
						<select name="city_name" class="w3-input w3-border w3-round w3-padding-small" id="city_name" onchange="selectedinfo()">
					   <option value="">-- Select City Name--</option>
						<?php
							$state_id=get_data("city_id,city_name","tbl_city");	
							if (isset($state_id)) {
								while ($row = mysqli_fetch_array($state_id))  {
										echo "<option  class='w3-text-black' value=" . $row[''] . ">" . $row[''] . "</option>";
									}
								}
							
						  ?>				  
		                </select>
	 </div>
	</body>
</html>