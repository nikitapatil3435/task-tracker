$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("#imgLoading").show();
    }).ajaxStop(function () {
        $("#imgLoading").hide();
    });
});
function save_report()
{
	debugger;
   var report_id = document.getElementById("report_id").value;
	var today_date=document.getElementById("today_date").value;
	var reporting_date = document.getElementById("r_date").value;
	var employee_id=document.getElementById("employee_name").value;
    var project_name = document.getElementById("project_name").value;
	//var project_id=$('#project_list option[value="' + project_name + '"]').attr('id');
    var module_name = document.getElementById("module_name").value;
    var form_name = document.getElementById("form_name").value;
    var task = document.getElementById("task").value;
    //var r_starttime = document.getElementById("r_starttime").value;
	var start_time = moment(document.getElementById("start_time").value,"HH:mm AA").format("HH:mm:ss");
	var end_time = moment(document.getElementById("end_time").value,"HH:mm AA").format("HH:mm:ss");
	//var r_endtime = document.getElementById("r_endtime").value;
	var task_status=document.getElementById("task_status").value;
	var mode = document.getElementById("mode").value;
	
	if(reporting_date=="")
	{
		alert("please enter Reporting Date");
		document.getElementById("reporting_date").focus();
        return;
	}
	
	if(task=="")
	{
		alert("please enter Task");
		document.getElementById("task").focus();
		return;
	}
	if(project_name==""){
		alert("please enter project name");
		document.getElementById("project_name").focus();
		return;
	}
	/*if (project_name!= "") {
                var pro_id = $('#project_list option[value ="' + project_name + '"]').attr('id'); // var emp_id(1) = $(list name option[value=" employee Name(namita)"].attr(1) <-to get this id =1 for that name we use (attr(id)) 
                if (pro_id == undefined){//when we put wrong input rather than list
			        alert("Please select valid project from the list");
			       document.getElementById("project_name").value = "";//we get value null
			        document.getElementById("project_name").focus();//focus to that field
						return;
					}

				} else {// when we put blank input
					alert("Please select project from the list");
					document.getElementById("project_name").focus();
					return;
				}*/
				
			 if(start_time=="Invalid date")
				{
					alert("please enter Project Start time");
					//$("#r_starttime").focus();
					return;
				}
				
			if(start_time > end_time)
			{
				 alert("please enter start time less than end time");
					 document.getElementById("start_time").focus();
					 return;
			}
   
   /* if(r_endtime!="" && r_starttime="")
	{
		alert("please enter start time before end time");
	}*/
	
	 if(end_time=="Invalid date")
	{
		 alert("please enter task end time");
		 //document.getElementById("r_endtime").focus();
		 return;
	}
	
	
	
	if(end_time!="Invalid date" &&  end_time < start_time)
    {
	 alert("please enter end time more than start time");
	$("#r_endtime").val("");
		// document.getElementById("r_endtime").value="";
		 return;
    }	
     $.ajax
    ({
        type: 'post',
        url: 'dal/dal_report.php',
        data: {
             report_save:'report_save',
			 report_id:report_id,
			 today_date:today_date,
			 reporting_date:reporting_date,
			 employee_id:employee_id,
			 project_name:project_name,
			 module_name:module_name,
			 form_name:form_name,
			 task:task,
             start_time:start_time,
             end_time:end_time,
			 task_status:task_status,
			 mode:mode
        },
        success: function (response)
		{
           debugger;
           if(response > 0){            	  
				alert("Record Save Successfully");
				location.reload();
				//location.href="report_list.php"			   
		   }
		 }  
         
    }); 
}
function edit_report(report_id)
{  
    debugger;
    
$.ajax
    ({
        type: 'post',
        url: 'dal/dal_report.php',
        data: {
             report_edit:'report_edit',
			 report_id:report_id
			 },
        success: function (response)
		{  
            debugger;
			location.reload();
			
			//location.href="report.php"
            
		}   
    }); 
}
function delete_report(report_id)
{ 
    debugger;
	if(confirm("do You Want delete?")){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_report.php',
			data: {
				 report_delete:'report_delete',
				 report_id:report_id
				 },
			success: function (response)
			{  
				debugger;
				if(response>0)
				{
					  alert("record deleted");
					  
				}	  
				location.reload();
				}   
		}); 	
	}	
}
function clear_session()
{
	debugger;    
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_report.php',
        data: {
                get_clear:'get_clear',
			 },
        success: function (response)
		{  
            debugger;
			location.href="report.php"            
		}   
    }); 
}
function report_list()
{ 
  debugger;
    
$.ajax
    ({
        type: 'post',
        url: 'dal/dal_report.php',
        data: {
                search_employee:'search_employee',
			 },
        success: function (response)
		{  
            debugger;
			location.href="report_list.php"
            
		}   
    }); 

}

function find_employee() //come from rp.php
{

  debugger;
   var emp_name = document.getElementById('emp_id').value;
	
    
	
	 if (emp_name != "") {
                var emp_id = $('#employee_name option[value ="' + emp_name + '"]').attr('id'); // var emp_id(1) = $(list name option[value=" employee Name(namita)"].attr(1) <-to get this id =1 for that name we use (attr(id)) 
                if (emp_id == undefined){//when we put wrong input rather than list
			        alert("Please select valid employee  from the list");
			       document.getElementById("emp_name").value = "";//we get value null
			        document.getElementById("emp_name").focus();//focus to that field
						return;
					}

				} else {// when we put blank input
					alert("Please select employee from the list");
					document.getElementById("emp_name").focus();
					return;
				}
	
	
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_report.php',
        data: {
               find_employee:'find_employee',
			   emp_id:emp_id,
			   emp_name:emp_name
			 },
        success: function (response)
		{  
            debugger;
			location.reload(); //go to document.ready function()in dal
            
		}   
    }); 

}

function date_change()//from line 139 ,onchange function .
{
	debugger;//to check values
	
	var r_date=document.getElementById("r_date").value;
	var from_date=document.getElementById("from_date").value;
	var to_date=document.getElementById("to_date").value;//get all 3 input filed to javascript
	if( r_date != ""){
		if( r_date < from_date || r_date > to_date)// if(r_date is less than from date  OR  r_date is greater than to date ) to_date - today date
		{//(1-01-2020 < 10-01-2020  || 18-01-2020 > 17-01-2020)
			alert("You can make reporting from 10 to today date");// msg display
			document.getElementById("r_date").value="";
			document.getElementById("r_date").focus();
			return;
		}
	}
}

function check_time()//from line 180 in report.php,onchange function
{
    debugger;
  var r_date=document.getElementById("r_date").value; //report date
  var employee_id=document.getElementById("employee_name").value;//employee name
  var r_starttime =moment(document.getElementById("start_time").value,"HH:mm AA").format("HH:mm:ss");//start time   --using  above 3 id we search -if record exist for particular date,employee_nm and start time
  //if( r_starttime >= "09:00:00" && r_starttime <= "18:00:00"){
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_report.php',
        data: {
              check_time:'check_time',
			   r_date: r_date,
			   r_starttime:r_starttime
			 },
        success: function (response){  
           debugger;
		   if(response==1){ 
	           alert("record exist for this time"); 
               $('#r_starttime').val(""); 			   
		   }   
	   }   
    }); 
 // }//else {  
         //alert("enter time betn 9 am  to 6 pm");
         //$('#r_starttime').val("");  
  // } 
}

 function chk_time()//from line 188 in report.php
{  
     var r_endtime = moment(document.getElementById("end_time").value,"HH:mm AA").format("HH:mm:ss");
	 var r_starttime = moment(document.getElementById("start_time").value,"HH:mm AA").format("HH:mm:ss");
	  
	 
	 
	 if(r_starttime!="Invalid date"){
	 if(r_endtime!="Invalid date" &&  r_endtime < r_starttime){
		alert("please enter end time more than start time");
		$("#r_endtime").val("");
		//$("#r_starttime").val("");
		 return;
     }
	 }
	 
	 //else if(r_endtime < "09:00:00" || r_endtime > "18:00:00"){
		// alert("enter end time more than 9 am and less than 6 pm");
		// $('#r_endtime').val(""); 
	// }
} 
function load_modules(){
	debugger;
	var project_name = document.getElementById("project_name").value;
	//var prf_id = $('#customer_name_list option[value="' + prf + '"]').attr('id');
    
	if(project_name!=undefined){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_report.php',
			data: {
				load_modules: 'load_modules',
				project_name:project_name
			},
			success: function (response) {
				debugger;
					//var mobile_no=response;
					document.getElementById("module_name").innerHTML=response;
			}
		})
	}
}
function load_form(){
	debugger;
	var project_name = document.getElementById("project_name").value;
	//var prf_id = $('#customer_name_list option[value="' + prf + '"]').attr('id');
    
	if(project_name!=undefined){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_report.php',
			data: {
				load_form: 'load_form',
				project_name:project_name
			},
			success: function (response) {
				debugger;
					//var mobile_no=response;
					document.getElementById("form_name").innerHTML=response;
			}
		})
	}
}

