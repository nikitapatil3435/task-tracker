$(document).ready(function(){
			$(document).ajaxStart(function () {
				$("#imgLoading").show();
			}).ajaxStop(function () {
				$("#imgLoading").hide();
			});
		});
function today_task_table(){
	$.ajax
	({
		type:'post',
		url:'dal/dal_dashboard.php',
		data:{
			today_task_table:'today_task_table',
		},
		success:function(response) {
			debugger;
			document.getElementById("filldata").innerHTML="";
			$("#filldata").append(response);
		}
	});
	$(document).ajaxStart(function () {
		$("#imgLoading").show();
	}).ajaxStop(function ()
		{
			$("#imgLoading").hide();
			$('#tbl_today_task').DataTable
			({
				destroy: true,
				"paging": true,
			});
		});
}
function pending_task_table(){
	$.ajax
	({
		type:'post',
		url:'dal/dal_dashboard.php',
		data:{
			pending_task_table:'pending_task_table',
		},
		success:function(response) {
			debugger;
			document.getElementById("filldata").innerHTML="";
			$("#filldata").append(response);
		}
	});
	$(document).ajaxStart(function () {
		$("#imgLoading").show();
	}).ajaxStop(function ()
		{
			$("#imgLoading").hide();
			$('#tbl_pending_task').DataTable
			({
				destroy: true,
				"paging": true,
			});
		});
}

function upcomming_task_table(){
	$.ajax
	({
		type:'post',
		url:'dal/dal_dashboard.php',
		data:{
			upcomming_task_table:'upcomming_task_table',
		},
		success:function(response) {
			debugger;
			document.getElementById("filldata").innerHTML="";
			$("#filldata").append(response);
		}
	});
	$(document).ajaxStart(function () {
		$("#imgLoading").show();
	}).ajaxStop(function ()
		{
			$("#imgLoading").hide();
			$('#tbl_upcomming_task').DataTable
			({
				destroy: true,
				"paging": true,
			});
		});
}
function recent_task_table(){
	$.ajax
	({
		type:'post',
		url:'dal/dal_dashboard.php',
		data:{
			recent_task_table:'recent_task_table',
		},
		success:function(response) {
			debugger;
			document.getElementById("filldata").innerHTML="";
			$("#filldata").append(response);
		}
	});
	$(document).ajaxStart(function () {
		$("#imgLoading").show();
	}).ajaxStop(function ()
		{
			$("#imgLoading").hide();
			$('#tbl_recent_task').DataTable
			({
				destroy: true,
				"paging": true,
			});
		});
}

function done_task(task_id){
	debugger;
	if(confirm("Do you want to done this task?")){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_dashboard.php',
			data: {
				done_task: 'done_task',
				task_id:task_id
			},
			success: function (response) {
				debugger;
				if(response==1){
				alert("Task Done Successfully");
				location.reload();
				}
			}
		});
	}
	
}
function delete_task(task_id){
	debugger;
	if(confirm("Do you want to delete this task?")){
		$.ajax
		({
			type: 'post',
			url: 'dal/dal_dashboard.php',
			data: {
				delete_task: 'delete_task',
				task_id:task_id
			},
			success: function (response) {
				debugger;
				if(response==1){
				alert("Task Deleted Successfully");
				location.reload();
				}
			}
		});
	}
	
}
function clear_session()//list to main page ->create task
{
    debugger;    
    $.ajax
    ({
        type: 'post',
        url: 'dal/dal_dashboard.php',
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