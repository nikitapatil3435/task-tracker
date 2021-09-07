$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("#imgLoading").show();
    }).ajaxStop(function () {
        $("#imgLoading").hide();
    });
});

function save_emp()
{
    debugger;
    var emp_id = document.getElementById("emp_id").value;
    var first_name = document.getElementById("first_name").value;
    var middle_name = document.getElementById("middle_name").value;
    var last_name = document.getElementById("last_name").value;
    var emp_address = document.getElementById("emp_address").value;
	var joining_date=document.getElementById("joining_date").value;
	var left_date=document.getElementById("left_date").value;
	if(left_date=="")
	{
		left_date="2050-01-01";
	}
    var employee_role = document.getElementById("employee_role").value;
    var email = document.getElementById("email").value;
    var user= document.getElementById("user_name").value;
	var reporting_authority = document.getElementById("reporting_authority").value;
	if(document.getElementById("male").checked){
		var gender=document.getElementById("male").value;
	}else if(document.getElementById("female").checked){
		var gender=document.getElementById("female").value;
	}
	if(document.getElementById("is_team_lead").checked){
		var is_team_lead=1;
	}else{
		var is_team_lead=0;
	}
	var mode = document.getElementById("mode").value;
    if(first_name==""){
			alert("please enter first name ");
			document.getElementById("first_name").focus();
           return;
	}	
	/*if(middle_name==""){
			alert("please enter middle name ");
			document.getElementById("middle_name").focus();
           return;
	}*/	
	if(last_name==""){
			alert("please enter last name ");
			document.getElementById("last_name").focus();
           return;
	}	
	if(emp_address==""){
		alert("please enter employee address ");
		document.getElementById("emp_address").focus();
	   return;
	}	
	if(joining_date=="")
	{
		 alert("please enter joining date");
		 document.getElementById("joining_date").focus();
		            return;
	}	
	if(left_date!="" && left_date < joining_date)
	{
	   alert("employee left date must be greater than employee joinging Date ");
	    document.getElementById("left_date").value='';
	    document.getElementById("left_date").focus();
        return;	   
    }   
    if(employee_role==""){
		 alert("please select employee role");
		 document.getElementById("employee_role").focus();
		  return;
	}
	 if(user==""){
		 alert("please create your user name for login");
		 document.getElementById("user_name").focus();
		  return;
	}
	if(reporting_authority==""){
		alert("please select reporting authority");
		document.getElementById("reporting_authority").focus();
		return;
	}
	
	var table = document.getElementById("pert_table");
    var table_len = (table.rows.length) - 1;
	var tr = table.getElementsByTagName("tr");
	
	for (i = 1; i < table_len; i++){	
		var id= tr[i].id.substring(3);
		if(document.getElementById("emp_fdate"+id).value==""){
	        alert("please enter Employee from Date");
			 document.getElementById("emp_fdate"+id).focus();
			 document.getElementById("emp_fdate"+id).value = "";
             return;
		}
		
	   if(document.getElementById("emp_fdate"+id).value==""&& document.getElementById("emp_fdate"+id).value<document.getElementById("emp_date"+id).value){
	         alert("employee from date must be greater than or equal to employee joinning date  ");
			  document.getElementById("emp_fdate"+id).focus();
			  document.getElementById("emp_fdate"+id).value = "";
              return;
		}
		if(document.getElementById("emp_tdate"+id).value==""){
	         alert("please enter Employee from Date");
			  document.getElementById("emp_tdate"+id).focus();
			   document.getElementById("emp_tdate"+id).value = "";
              return;
		}
		if(document.getElementById("emp_tdate"+id).value!="" && document.getElementById("emp_tdate"+id).value<document.getElementById("emp_fdate"+id).value){
			alert("employee To Date must be greater than from date");
			document.getElementById("emp_tdate"+id).focus();
			document.getElementById("emp_tdate"+id).value = "";
            return;
	    }
		if(document.getElementById("emp_min"+id).value==""){
	        alert("Enter employee rate_per_min ");
			document.getElementById("emp_min").focus();
            return;
	    }				 
	}
	 /*if(table_len==1){ 
		alert("write data on the table ");
	    document.getElementById("emp_fdate"+id).focus();
        return;
	} */
    $.ajax
    ({
        type: 'post',
        url: 'dal/dal_employee.php',
        data: {
			 get_save:'get_save',
			 emp_id:emp_id,
			 first_name:first_name,
             middle_name:middle_name,
			 last_name :last_name,
			 emp_address:emp_address,
			 joining_date:joining_date,
			 left_date:left_date,
			 employee_role:employee_role,
			 email:email,
			 reporting_authority:reporting_authority,
			 gender:gender,
			 is_team_lead:is_team_lead,
			 user:user,
			 mode:mode
        },
        success: function (response)
		{  
		    debugger;
		    if(response > 0){
				alert("Employee Saved Successfully");
				location.href="employeeContact.php";
			}
            /*debugger;
			var ajax_complete=0;
			var num=0;
			if(response>0){
				for (i = 1; i <= table_len; i++)
				{	
					 var id= tr[i].id.substring(3);
					document.getElementById("emp_id").value=response;
					var emp_id = document.getElementById("emp_id").value;
					var emp_pert_id= document.getElementById("emp_pert_id"+id).value;
					var emp_fdate= document.getElementById("emp_fdate"+id).value;
					var emp_tdate = document.getElementById("emp_tdate"+id).value;
					var emp_min = document.getElementById("emp_min"+id).value
					 var mode = document.getElementById("mode"+id).value
					num++;
					 $.ajax
					 ({  type: 'post',
						 url: 'dal/dal_emp.php',
						data: {
								
								pert_save:'pert_save',
								emp_pert_id:emp_pert_id,
								emp_id:emp_id,
								emp_fdate:emp_fdate,
								emp_tdate:emp_tdate,
								emp_min:emp_min,
								mode:mode
						},
					    success: function (response){
							debugger;
							ajax_complete++;
							if(ajax_complete==num){
								alert("Record added successfully");
							    location.href="employeeContact.php"
							}	
						}	 
					});
				}		
			}else{
			 alert("record not save");
			}*/
		}    
    }); 
}
function edit_employee(emp_id)
{  
    debugger; 
    highlight_row()	
    $.ajax
    ({
        type: 'post',
        url: 'dal/dal_employee.php',
        data: {
             get_edit:'get_edit',
			 emp_id:emp_id
			 },
        success: function (response)
		{  
            debugger;
			location.href="employee.php"
            
		}   
    }); 
}
function highlight_row() {
    var table = document.getElementById('tblemployeedetails');
    var cells = table.getElementsByTagName('td');

    for (var i = 0; i < cells.length; i++) {
        // Take each cell
        var cell = cells[i];
        // do something on onclick event for cell
        cell.onclick = function () {
            // Get the row id where the cell exists
            var rowId = this.parentNode.rowIndex;

            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) {
                rowsNotSelected[row].style.backgroundColor = "";
                rowsNotSelected[row].classList.remove('selected');
            }
            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.style.backgroundColor = "lightblueblue";
            rowSelected.className += " selected";

           // msg = 'The ID of the company is: ' + rowSelected.cells[0].innerHTML;
           // msg += '\nThe cell value is: ' + this.innerHTML;
           // alert(msg);
        }
    }

}
function delete_employee(emp_id)
{
	
	debugger;
	
	if(confirm("Do You Want To Delete Employee Details?")){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_employee.php',
			data: {
				 get_delete:'get_delete',
				 emp_id:emp_id
				 },
			success: function (response)
			{  
				debugger;
				 if(response > 0)
				 {
					  alert("Employee Details Deleted  Successfully");
					  
				 }	  
				location.reload();
				}   
		}); 
	}
	highlight_row()	

			
}

function clear_session()//list to main page ->create employee
{
	  debugger;
    
$.ajax
    ({
        type: 'post',
        url: 'dal/dal_employee.php',
        data: {
                get_clear:'get_clear',
			 },
        success: function (response)
		{  
            debugger;
			location.href="employee.php"
            
		}   
    }); 

}

function search_employee()
{ 
  debugger;    
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_employee.php',
        data: {
                search_employee:'search_employee',
			 },
        success: function (response)
		{  
            debugger;
			location.href="employee_list.php"            
		}   
    }); 
}


function insert_row() {// pert row to insert data
    debugger;
    var table = document.getElementById("pert_table");
	var table_len = (table.rows.length) - 1;
	var tr = table.getElementsByTagName("tr");
	var is_empty = 0;
	var id = 0;
	var emp_date = document.getElementById("emp_date").value;
	var emp_fdate = document.getElementById("emp_fdate0").value;
    var emp_tdate = document.getElementById("emp_tdate0").value;
    var emp_min = document.getElementById("emp_min0").value;
    if(document.getElementById("emp_fdate0").value==""){
	         alert("please enter Employee from Date");
			  document.getElementById("emp_fdate0").focus();
			  	document.getElementById("emp_fdate0").value = "";
              return;
		}
		if(document.getElementById("emp_fdate0").value!="" && document.getElementById("emp_fdate0").value < document.getElementById("emp_date").value){
			alert("employee from date must be greater than or equal to employee joinning date ");
			document.getElementById("emp_fdate0").focus();
			document.getElementById("emp_fdate0").value = "";
            return;
	    }
		
		if(document.getElementById("emp_tdate0").value==""){
	         alert("please enter Employee To Date");
			  document.getElementById("emp_tdate0").focus();
			  	document.getElementById("emp_tdate0").value = "";
			  return;
		}
		
		if(document.getElementById("emp_tdate0").value!="" && document.getElementById("emp_tdate0").value < document.getElementById("emp_fdate0").value){
			alert("employee To Date must be greater than from date ");
			document.getElementById("emp_tdate0").focus();
			document.getElementById("emp_tdate0").value = "";
            return;
	    }
		if(document.getElementById("emp_min0").value==""){
	        alert("Please enter employee min ");
			document.getElementById("emp_min0").focus();
            return;
	    }		
    for (i = 1; i < table_len; i++) {
		var n = tr[i].id.substring(3);
        var id = n;
    }
  
	id++;
    var row = table.insertRow(table_len).outerHTML = '<tr id="row' + id + '">' +
      '<td data-label="Employee Joinning Date" class="w3-col s12 m12 l4 "> <input type="text" class="w3-input w3-border" id="emp_fdate' + id + '" value="' + emp_fdate + '" name="emp_fdate" onkeypress="return validateFloatKeyPress(this, event, 18, 1);"></td>' +
     '<td data-label="Employee Left Date" class="w3-col s12 m12 l4 "> <input type="text" class="w3-input w3-border" id="emp_tdate' + id + '" value="' + emp_tdate + '" name="emp_tdate" onkeypress="return validateFloatKeyPress(this, event, 18, 1);" ></td>' +
     '<td data-label="Employee Rate Per Minute" class="w3-col s12 m12 l3 "> <input type="text" class="w3-input w3-border" id="emp_min' + id + '" value="' + emp_min + '" name="emp_min" onkeypress="return validateFloatKeyPress(this, event, 18, 1);"></td>' +
     '<td data-label="Option" class="w3-col s12 m12 l1">'+
     '<a href="#"  class="w3-ripple w3-large w3-text-red" id="delete' + id + '" onclick="delete_row(' + id + ')"><b><i class="fa fa-trash"></i></b></a>' +
     '<input id="emp_pert_id' + id + '" class="w3-input w3-hide" value="' + id + '"></td>' +
     '<input id="mode' + id + '" class="w3-input w3-hide" value="1">' +
     '</tr>';
     debugger;
    // document.getElementById("sub_code"+id).value=sub_code;
    document.getElementById("emp_fdate0").value = "";
    document.getElementById("emp_fdate0").focus();
    document.getElementById("emp_tdate0").value = "";
    document.getElementById("emp_min0").value = "";
  }
  
  function check_date(id)
  {
	  debugger;
	  var table = document.getElementById("pert_table");
	  var table_len = (table.rows.length) - 1;
	  var tr = table.getElementsByTagName("tr");
	  var emp_fdate = document.getElementById("emp_fdate"+id).value;
	  for(i=1;i<=table_len;i++)
	  {
	     	var n = tr[i].id.substring(3);
			var f_row = document.getElementById("emp_fdate"+n).value;
			var t_row = document.getElementById("emp_tdate"+n).value
            if((emp_fdate == f_row || emp_fdate <= t_row ) && n!=id)
            {
				alert("record exist for this from date ");
				document.getElementById("emp_fdate"+id).value = "";
				document.getElementById("emp_fdate"+ id).focus();
				return;
				
            }			 
	  }
	  
  }
  
  function delete_row(id){ 
	 var emp_pert_id= document.getElementById("emp_pert_id"+id).value;
	  $.ajax
    ({
        type: 'post',
        url: 'dal/dal_employee.php',
        data: {
                get_delete_pert:'get_delete_pert',
				id:emp_pert_id,
			 },
        success: function (response)
		{  
            debugger;
            
		}   
    });
	var row = document.getElementById("row" + id);
		row.parentNode.removeChild(row);	

  }
function approve_entry(emp_id,rep_date)
{
	debugger;
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_employee.php',
        data: {
             get_check:'get_check',
			 emp_id:emp_id,
			 rep_date:rep_date
			 },
        success: function (response)
		{  
            debugger;
			location.reload();
		} 
    }); 

	
}
function appr_type(type) {
    debugger;
    $.ajax({
        type: 'post',
        url: 'dal/dal_employee.php',
        data: {
            appr_type: 'appr_type',
			type:type,
        },
        success: function(response) {
            debugger;
            location.reload();
        }
    })
}

function find_list()
{ 
  debugger;
  var from_date=document.getElementById("from_date").value;
  var To_date=document.getElementById("To_date").value;

    
$.ajax
    ({
        type: 'post',
        url: 'dal/dal_employee.php',
        data: {
               find_employee:'find_employee',
			   from_date:from_date,
			   To_date:To_date
			 },
        success: function (response)
		{  
            debugger;
			location.reload(); //go to document.ready function()in dal            
		}   
    }); 
}
function edit_profile(id, page) {
    $.ajax
    ({
		type: 'post',
		url: 'dal/dal_employee.php',
		data: {
			edit_profile: 'edit_profile',
			PrfId: id,
		},
		success: function (response) {
			location.href = page;
		}
    })
}
//save pert for contact details
function save_pert() {
	debugger;
    var AddUserId = document.getElementById("AddUserId").value;
    var table = document.getElementById("mytable");
    var table_len = (table.rows.length) - 1;
    var tr = table.getElementsByTagName("tr");
    for (i = 1; i <= table_len; i++) {
        var id = tr[i].id.substring(4);
        var ctype = document.getElementById("s_ctype" + id).value;
        var details = document.getElementById("s_details" + id).value;
     }
	var ajax_complete = 0;
    for (i = 1; i <= table_len; i++) {
        var id = tr[i].id.substring(4);
        var PPId = document.getElementById("pert_id" + id).value;
        var ctype = document.getElementById("s_ctype" + id).value;
        var details = document.getElementById("s_details" + id).value;
        var remark = document.getElementById("s_remark" + id).value;
        var mode = document.getElementById("s_mode" + id).value;
        if (document.getElementById("s_default" + id).checked) {
            var is_default = 1;
        } else {
            var is_default = 0;
        }
		if(ctype==1 &&details==''){
			alert('Please provide Mobile Number')
            document.getElementById("s_details" + id).focus();
            return;
		}
        $.ajax
        ({
               type: 'post',
               url: 'dal/dal_employee.php',
               data: {
                        save_pert: 'save_pert',
                        PPId: PPId,
                        ctype: ctype,
                        details: details,
                        remark: remark,
                        mode: mode,
                        is_default: is_default,
                        AddUserId: AddUserId,
                     },
                    success: function (response) {
						debugger;
						ajax_complete++;
						if(ajax_complete == table_len){
							location.href = "employee_list.php";
						}
                    }
           });
    }
}

