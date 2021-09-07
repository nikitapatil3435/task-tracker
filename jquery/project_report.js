$(document).ready(function(){
			$(document).ajaxStart(function () {
				debugger;
				$("#imgLoading").show();
			}).ajaxStop(function () {
				$("#imgLoading").hide();
			});
			
		});
//function to show text boxes for different different select types 
function HideShow()
{
	debugger;
	var reportname=document.getElementById("rid").value;
		document.getElementById("project_name_div").style.display="none";
		document.getElementById("employee_name_div").style.display="none";
		document.getElementById("from_date_div").style.display="none";
		document.getElementById("to_date_div").style.display="none";
		
		document.getElementById("view_div").style.display="none";
		//document.getElementById("excel_div").style.display="none";
		if(reportname==1){
			document.getElementById("project_name_div").style.display="block";
			document.getElementById("from_date_div").style.display="block";
			document.getElementById("to_date_div").style.display="block";
			document.getElementById("view_div").style.display="block";
			
		}
		if(reportname==2){
			document.getElementById("project_name_div").style.display="block";
			document.getElementById("from_date_div").style.display="block";
			document.getElementById("to_date_div").style.display="block";
			document.getElementById("view_div").style.display="block";
		}
		if(reportname==3){
			document.getElementById("project_name_div").style.display="block";
			document.getElementById("from_date_div").style.display="block";
			document.getElementById("to_date_div").style.display="block";
			document.getElementById("view_div").style.display="block";
		}
		if(reportname==4){
			document.getElementById("project_name_div").style.display="block";
			document.getElementById("from_date_div").style.display="block";
			document.getElementById("to_date_div").style.display="block";
			document.getElementById("view_div").style.display="block";
		}
		if(reportname==5){
			document.getElementById("project_name_div").style.display="block";
			document.getElementById("employee_name_div").style.display="block";
			document.getElementById("from_date_div").style.display="block";
			document.getElementById("to_date_div").style.display="block";
			document.getElementById("view_div").style.display="block";
			
		}
}
//function to generate pdf
function generate_pdf() {
    debugger;
	if(reportname==undefined){
	   var reportname=document.getElementById("rid").value;
	}
	if(reportname==1){		
		var ProjectName = document.getElementById("project_name").value;
		if (ProjectName != "") {
			var project = $('#project_list option[value="' + ProjectName + '"]').attr('id');
			if (project == undefined) {
				alert("Please Select Project");
				document.getElementById("project_name").focus();
				return;
			}
		}else{
			alert("Please Select Project ");
			document.getElementById("project_name").focus();
			return;
		}
		    debugger;    
    $.ajax
    ({
        type: 'post',
        url: 'dal.dashboard.php',
        data: {
                generate_pdf:'generate_pdf',
                project:project
			 },
        success: function (response)
		{  
            debugger;
			if(response > 0){
				alert("ok");
			}
			//location.href="task.php"
            
		}   
    }); 
	}
}
