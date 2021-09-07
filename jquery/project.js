$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("#imgLoading").show();
    }).ajaxStop(function () {
        $("#imgLoading").hide();
    });
});
function save_info(){
	debugger;
	var p_id = document.getElementById("p_id").value;
	var today_date=document.getElementById("today_date").value;
    var p_name = document.getElementById("p_name").value;
	var p_description = document.getElementById("p_description").value;
    var p_startdate = document.getElementById("p_startdate").value;
	var p_enddate = document.getElementById("p_enddate").value;
	var p_kilometer = Number(document.getElementById("p_kilometer").value);
	var p_cost=Number(document.getElementById("p_cost").value);
	var amc_amount=Number(document.getElementById("amc_amount").value);
	var amc_date=document.getElementById("amc_date").value;
	var mode = document.getElementById("mode").value;
    if(p_name==""){
	    alert("Please Enter Project Name ");
		document.getElementById("p_name").focus();
        return;
	}
	if(p_enddate!="" && p_enddate<p_startdate){
		alert("Project complete date must be greater than Start Date ");
		document.getElementById("p_enddate").focus();
        return; 
	}
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_project.php',
        data: {
             get_save:'get_save',
			 p_id:p_id,
			 today_date:today_date,
             p_name:p_name,
			 p_description: p_description,
			 p_startdate :p_startdate,
			 p_enddate:p_enddate,
			 p_kilometer:p_kilometer,
			 p_cost:p_cost,
			 amc_amount:amc_amount,
			 amc_date:amc_date,
			 mode:mode
        },
        success: function (response){
            debugger;
            if(response>0){    
		      if(mode==2)
			   { alert("record updated");}
		      else{
				 alert("record inserted");}
			     location.href="project_list.php"  
		      }
		 }    
    }); 
}

function edit_project(p_id)
{  
    debugger;
    
$.ajax
    ({
        type: 'post',
        url: 'dal/dal_project.php',
        data: {
             get_edit:'get_edit',
			 p_id:p_id
			 },
        success: function (response)
		{  
            debugger;
			location.href="project.php"
            
		}   
    }); 

}
function delete_project(p_id)
{
	debugger;
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_project.php',
        data: {
             get_delete:'get_delete',
			 p_id:p_id
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
function clear_session()
{
	  debugger;
    
$.ajax
    ({
        type: 'post',
        url: 'dal/dal_project.php',
        data: {
                get_clear:'get_clear',
			 },
        success: function (response)
		{  
            debugger;
			location.href="project.php"
            
		}   
    }); 

}
function Generate_Excel()
{   debugger;

  var from_date=document.getElementById("from_date").value;
  var To_date=document.getElementById("To_date").value;

  $.ajax
    ({
        type: 'post',
        url: 'dal/dal_project.php',
        data: {
                get_excel:'get_excel',
				from_date:from_date,
				To_date: To_date
			 },
        success: function (response)
		{  
            debugger;
			location.href="excel_reports/project_report_excel.php"
            
		}   
    }); 

}
function search_employee()
{ 
  debugger;
    
$.ajax
    ({
        type: 'post',
        url: 'dal/dal_project.php',
        data: {
                search_employee:'search_employee',
			 },
        success: function (response)
		{  
            debugger;
			location.href="project_list.php"
            
		}   
    }); 

}


	