$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("#imgLoading").show();
    }).ajaxStop(function () {
        $("#imgLoading").hide();
    });
});
//function for edit 
function save_task(){
	debugger;
	var task_id=document.getElementById("task_id").value;
	var project_name=document.getElementById("project_name").value;
	var module_name=document.getElementById("module_name").value;
	var form_name=document.getElementById("form_name").value;
	var task_description=document.getElementById("description").value;
	var assign_to=document.getElementById("assigned_to").value;
	var due_date=document.getElementById("due_date").value;
	var end_date=document.getElementById("end_date").value;
	var mode=document.getElementById("mode").value;
	if(project_name==""){
		alert("Please Select Project from List");
		document.getElementById("project_name").focus();		
	}
	if(form_name==""){
		alert("Please Select Form From List");
		document.getElementById("form_name").focus();		
	}
	if(task_description==""){
		alert("Please Add Some Task Description");
		document.getElementById("description").focus();		
	}
	if(assign_to==""){
		alert("Please Select a person to assign task");
		document.getElementById("form_name").focus();		
	}
	if(due_date==""){
		alert("Please Select Due Date");
		document.getElementById("due_date").focus();		
	}
	if(end_date==""){
		alert("Please Select End Date");
		document.getElementById("end_date").focus();		
	}
	if(due_date > end_date){
		alert("End date should be greater than due date");
		document.getElementById("end_date").focus();
	}
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_task.php',
        data: {
             save_task:'save_task',
			 task_id:task_id,
			 project_name:project_name,
			 module_name:module_name,
			 form_name:form_name,
			 task_description:task_description,
			 assign_to:assign_to,
			 due_date:due_date,
			 end_date:end_date,
			 mode:mode
        },
        success: function (response)
		{
           debugger;
           if(response > 0){            	  
				alert("Task Assign Successfully");
				location.reload();
				location.href="task_list.php"			   
		   }
		 }  
         
    }); 
	
}
//function for edit tasks
function edit_task(task_id)
{  
    debugger;
    
$.ajax
    ({
        type: 'post',
        url: 'dal/dal_task.php',
        data: {
             edit_task:'edit_task',
			 task_id:task_id
			 },
        success: function (response)
		{  
            debugger;
			location.reload();
			location.href="task.php";
			//location.href="report.php"
            
		}   
    }); 
}
function clear_session()//list to main page ->create task
{
    debugger;    
    $.ajax
    ({
        type: 'post',
        url: 'dal/dal_task.php',
        data: {
                get_clear:'get_clear',
			 },
        success: function (response)
		{  
            debugger;
			location.href="task.php"
            
		}   
    }); 

}
//delete machine records
function delete_task(task_id)
{
	//debugger;
	 if(confirm("Are you sure you want to delete?")){
	$.ajax
	({
		type:'post',
		url:'dal/dal_task.php',
		data:{
			delete_task:'delete_task',
			task_id:task_id
	
	},
	success: function (response) {
		     debugger;
			location.href="task_list.php"			   
	}
	});
	}	
}
function load_modules(){
	debugger;
	var project_name = document.getElementById("project_name").value;
	//var prf_id = $('#customer_name_list option[value="' + prf + '"]').attr('id');
    
	if(project_name!=undefined){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_task.php',
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
			url: 'dal/dal_task.php',
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