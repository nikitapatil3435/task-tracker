function create_table()
{
	var project_name=document.getElementById("project_id").value;
	var pro_id = $('#project_list option[value ="' + project_name + '"]').attr('id');
	$.ajax
            ({
                type: 'post',
                url: 'dal/dal_doc.php',
                data: {
                      create_table:'create_table',
					  pro_id:pro_id,
					  
                },
				success: function (response) {
                    debugger;
					location.reload();
				}	
		 }); 
}

$(document).ready(function (e) {
    debugger;
	$("#uploaddoc").on('submit',(function(e) {
			debugger;
			e.preventDefault();
			debugger;
			var formdata = new FormData(this);
			upload_file(formdata);
	}));
});
function upload_file(formdata) {// pert row to insert data
    debugger;
	var project_id = document.getElementById("project_row_id").value;
    var table = document.getElementById("doc_table"+project_id);
	var table_len = (table.rows.length) - 1;
	var tr = table.getElementsByTagName("tr");
    id = project_id+ '_0';
	var project_document_id = document.getElementById("project_document_id"+id).value;
	var file_type_id = document.getElementById("file_type_id"+id).value;
    var file_name= document.getElementById("file_name"+id).value;
   // var file_id = '-';
    var file_id= document.getElementById("file_id"+id).files[0].name;
	var mode = document.getElementById("mode"+id).value;
	 if(document.getElementById("file_type_id"+id).value==""){
	         alert("please enter file Type");
			  document.getElementById("file_type_id"+id).focus();
              return;
		}
		if(document.getElementById("file_name"+id).value==""){
			alert("Please enter file Name");
			document.getElementById("file_name"+id).focus();
            return;
	    }
		if(document.getElementById("file_id"+id).value==""){
	        alert("Please choose file ");
			document.getElementById("file_id"+id).focus();
            return;
	    }		
	$.ajax
    ({
        type: 'post',
        url: 'dal/dal_doc.php',
        data: {
			 get_save:'get_save',
			 project_document_id:project_document_id,
			 project_id:project_id,
             file_type_id:file_type_id,
			 file_name :file_name,
			 file_id:file_id,
			 mode:mode
        },
        success: function (response)
		{    debugger;
		    if(response>0){
				$.ajax({
                    async: false,
                    url: "doc.php",
                    type: "POST", 
                    data:formdata,
                    contentType: false, 
                    cache: false,
                    processData: false, 
                    success: function (data)
                    {
                        debugger;
						file_id=data;
                    }
                });
            
			
				var new_id=0;
				var subact_len = 3 + (project_id.toString().length) + 1;
				for (i = 1; i < table_len; i++) {
					n = tr[i].id.substring(subact_len);
					var new_id = n;
				}
				new_id++;
				var row_id = project_id+ '_' + new_id;
				new_id = row_id;
				var new_id_str="'"+new_id+"'";
				var blank_row = project_id + '_0';
				 var row = table.insertRow(table_len).outerHTML = '<tr id="row' + new_id + '">' +
				 '<td data-label="File Type" class="w3-center"><select type="text" class="w3-input w3-border w3-col s12 l3" id="file_type_id' + new_id + '" disabled value="' + file_type_id + '" name="file_type_id" >'+
				 document.getElementById("file_type_id"+blank_row).innerHTML+
				 '</select></td>' +
				 '<td data-label="File Name" class="w3-center" >' + file_name + '</td>' +//we want only value instead of input box
				 '<td data-label="File" class="w3-center" >' + file_id + '</td>' +
				 '<td data-label="Option" class="w3-center"  >'+
				 '<a href="#"  class="w3-ripple w3-large w3-text-red" id="delete' + new_id + '" onclick="delete_row(' +  new_id_str  + ')"><b><i class="fa fa-trash"></i></b></a>' +
				 '<input id="project_document_id' + new_id + '" class="w3-input w3-hide" value="' + id + '"></td>' +
				 '<input id="mode' + new_id + '" class="w3-input w3-hide" value="1">' +
				 '</tr>';
				 debugger;
				document.getElementById("file_type_id"+new_id).value=file_type_id;
				document.getElementById("file_type_id"+blank_row).value = "";
				document.getElementById("file_type_id"+blank_row).focus();
				document.getElementById("file_name"+blank_row).value = "";
				document.getElementById("file_id"+blank_row).value = "";
			}
		}
	});
	
}

 function delete_row(id){//id as  parameter
     debugger;
	 var project_document_id= document.getElementById("project_document_id"+id).value;
	  $.ajax
    ({
        type: 'post',
        url: 'dal/dal_doc.php',
        data: {
                get_delete_pert:'get_delete_pert',
				id:project_document_id,
			 },
        success: function (response)
		{  
            debugger;
            
		}   
    });
	var row = document.getElementById("row" + id);
		row.parentNode.removeChild(row);	

  }
  
function check_file(id)
{     debugger;
     var file_type_id = document.getElementById("file_type_id"+id).value;
	  var file_name=document.getElementById("file_name"+id).value;
	   var project_id=document.getElementById("project_row_id").value;
	  if(file_type_id!="" && file_name!=""){
		$.ajax
    ({
        type: 'post',
        url: 'dal/dal_doc.php',
        data: {
                check_file:'check_file',
			   file_type_id:file_type_id,
			   file_name:file_name,
			   project_id:project_id
			 },
        success: function (response){  
           debugger;
		   if(response==1){ 
	           alert("Record exist for this file type and file Name"); 
               	   
		   }   
	   }   
    }); 
}
}	