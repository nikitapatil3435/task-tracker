function load_state(){
	debugger;
	var country_name = document.getElementById("country_name").value;
	//var prf_id = $('#customer_name_list option[value="' + prf + '"]').attr('id');
    
	if(country_name!=undefined){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_demo.php',
			data: {
				load_state: 'load_state',
				country_name:country_name
			},
			success: function (response) {
				debugger;
					//var mobile_no=response;
					document.getElementById("state_name").innerHTML=response;
			}
		})
	}
}
function load_city(){
	debugger;
	var state_name = document.getElementById("state_name").value;
	//var prf_id = $('#customer_name_list option[value="' + prf + '"]').attr('id');
    
	if(state_name!=undefined){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_demo.php',
			data: {
				load_city: 'load_city',
				state_name:state_name
			},
			success: function (response) {
				debugger;
					//var mobile_no=response;
					document.getElementById("city_name").innerHTML=response;
			}
		})
	}
}
function selectedinfo(){
	debugger;
	var cname = document.getElementById("country_name");
	var name = cname.options[cname.selectedIndex].text;
	
	var state_name = document.getElementById("state_name");
	var state=state_name.options[state_name.selectedIndex].text;
  //const state= $('#state_name option[value="' + state_name + '"]').attr('id');
  var city_name = document.getElementById("city_name");
  var city = city_name.options[city_name.selectedIndex].text;
  console.log("Country:"+name+ "<\n>state:"+state+"<\n>city:"+city);

	
	
}