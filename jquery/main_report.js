function show_crieteria()
{
	debugger;
    document.getElementById("tcs_amt_report").style.display = 'none';
     var report_name = document.getElementById("report_name").value;
    if (report_name == 1)
    {
        var element = document.getElementById("tcs_amt_report");
        element.style.display = 'block';
        document.getElementById("btn_pdf").style.display = 'block';
    }
if (report_name == 2)
    {
        var element = document.getElementById("tcs_amt_report");
        element.style.display = 'block';
        document.getElementById("btn_pdf").style.display = 'block';
    }
if (report_name == 3)
    {
        var element = document.getElementById("tcs_amt_report");
        element.style.display = 'block';
        document.getElementById("btn_pdf").style.display = 'block';
    }
if (report_name == 4)
    {
        var element = document.getElementById("tcs_amt_report");
        element.style.display = 'block';
        document.getElementById("btn_pdf").style.display = 'block';
    }
   }

function execute_report()
{
    var report_name = document.getElementById("report_name").value;
    if (report_name == 1)
    {
            report_name = "Complete task";
            $.ajax
                    ({
                        type: 'post',
                        url: 'dal/dal_report.php',
                        data: {
                            genrate_report: 'genrate_report',
                            report_name: report_name,
                            },
                        success: function (response) {
                            debugger;
                            location.href ="project_report.php"
                        }
                    });
    } 
if (report_name == 2)
    {
            report_name = "Incomplete task";
            $.ajax
                    ({
                        type: 'post',
                        url: 'dal/dal_report.php',
                        data: {
                            incomplete_task: 'incomplete_task',
                            report_name: report_name,
                            },
                        success: function (response) {
                            debugger;
                            location.href ="incomplete_task_report.php"
                        }
                    });
    }
if (report_name == 3)
    {
            report_name = "Inprogress task";
            $.ajax
                    ({
                        type: 'post',
                        url: 'dal/dal_report.php',
                        data: {
                            Inprogress_task: 'Inprogress_task',
                            report_name: report_name,
                            },
                        success: function (response) {
                            debugger;
                            location.href ="inprogress_task.php"
                        }
                    });
    }
	if (report_name == 4)
    {
            report_name = "Ticket Genration";
            $.ajax
                    ({
                        type: 'post',
                        url: 'dal/dal_report.php',
                        data: {
                            Inprogress_task: 'Inprogress_task',
                            report_name: report_name,
                            },
                        success: function (response) {
                            debugger;
                            location.href ="ticket_generation_excel_report.php"
                        }
                    });
    }

 }

   
function show_report()
{
debugger
    var report_name = document.getElementById("report_name").value;

    if (report_name == 1)
    {
        report_name = "Complete task";
        
        $.ajax
                ({
                    type: 'post',
                    url: 'complete_task_report.php',
                    data: {
                        complete_task_report: 'complete_task_report',
                        
                    },
                    success: function (response) {
                        debugger;
                        if (response != "") {
                            window.open(response);
                        } else {
                            alert("No data found");
                        }
                    }
                });
    }
if (report_name == 2)
    {
        report_name = "Incomplete task";
        
        $.ajax
                ({
                    type: 'post',
                    url: 'incomplete_task_report.php',
                    data: {
                        incomplete_task_report: 'incomplete_task_report',
                        
                    },
                    success: function (response) {
                        debugger;
                        if (response != "") {
                            window.open(response);
                        } else {
                            alert("No data found");
                        }
                    }
                });
    }
if (report_name == 3)
    {
        report_name = "Inprogress task";
        
        $.ajax
                ({
                    type: 'post',
                    url: 'inprogress_task_report.php',
                    data: {
                        inprogress_task_report: 'inprogress_task_report',
                        
                    },
                    success: function (response) {
                        debugger;
                        if (response != "") {
                            window.open(response);
                        } else {
                            alert("No data found");
                        }
                    }
                });
    }
}
if (report_name == 3)
    {
        report_name = "Ticket Generation";
        
        $.ajax
                ({
                    type: 'post',
                    url: 'inprogress_task_report.php',
                    data: {
                        inprogress_task_report: 'inprogress_task_report',
                        
                    },
                    success: function (response) {
                        debugger;
                        if (response != "") {
                            window.open(response);
                        } else {
                            alert("No data found");
                        }
                    }
                });
    }
}
    
