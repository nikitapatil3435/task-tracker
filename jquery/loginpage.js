$(document).ready(function () {
	$(document).ajaxStart(function () {
		$("#imgLoading").show();
	}).ajaxStop(function () {
		$("#imgLoading").hide();
	});	
});

function get_menu(){
	debugger;
	var user_id = document.getElementById("user").value;
	var menu= document.getElementById("menu");
	var menu_items = menu.getElementsByTagName("a");
	var items = "";
	var links="";
	var ref = "";
	var pref = "";
	var menu_text = "";
	for(i=0;i<menu_items.length;i++){
		items = items+menu_items[i].getAttribute("data-menu")+",";
		links = links+menu_items[i].getAttribute("href")+",";
		ref = ref+menu_items[i].getAttribute("data-ref")+",";
		pref = pref+menu_items[i].getAttribute("pref")+",";
		menu_text = menu_text+menu_items[i].innerHTML+",";
	}
	$.ajax
	({
		type:'post',
		url:'dal/dal_loginpage.php',
		data:{
			get_menu:'get_menu',
			items:items,
			links:links,
			ref:ref,
			menu_text:menu_text,
			pref:pref,
			user_id:user_id,
		},success:function(response) {
			debugger;
			document.getElementById("user_rights").innerHTML =response;
		}
	})
}

function toggle_check(id){
	if(document.getElementById("is_allowed"+id).checked){
		document.getElementById("insert"+id).disabled= false;
		document.getElementById("edit"+id).disabled= false;
		document.getElementById("delete"+id).disabled= false;
		document.getElementById("search"+id).disabled= false;
		document.getElementById("default"+id).disabled= false;
		document.getElementById("print"+id).disabled= false;
		document.getElementById("approve"+id).disabled= false;
	}else{
		document.getElementById("insert"+id).disabled= true;
		document.getElementById("edit"+id).disabled= true;
		document.getElementById("delete"+id).disabled= true;
		document.getElementById("search"+id).disabled= true;
		document.getElementById("default"+id).disabled= true;
		document.getElementById("print"+id).disabled= true;
		document.getElementById("approve"+id).disabled= true;
		document.getElementById("insert"+id).checked= false;
		document.getElementById("edit"+id).checked= false;
		document.getElementById("delete"+id).checked= false;
		document.getElementById("search"+id).checked= false;
		document.getElementById("default"+id).checked= false;
		document.getElementById("print"+id).checked= false;
		document.getElementById("approve"+id).checked= false;
	}
}


function save(){
	debugger;
	var user_id = document.getElementById("user").value;
	$.ajax
	({
		type:'post',
		url:'dal/dal_loginpage.php',
		data:{
			delete_setting:'delete_setting',
			user_id:user_id,
		},success:function(response) {
			debugger;
				var row_no = document.getElementById("row_no").value;
				var ajax_complete=0;
				for(id=1;id< row_no-1; id++){
					var is_allowed=0;
					var isinsert=0;
					var isedit=0;
					var isdelete=0;
					var issearch=0;
					var isprint=0;
					var isapprove=0;
					var is_default=0;
					var menu = document.getElementById("menuname"+id).innerHTML;
					var menu_link = document.getElementById("menu_link"+id).innerHTML;
					var menu_ref = document.getElementById("menu_ref"+id).innerHTML;
					var menu_text = document.getElementById("menu_text"+id).innerHTML;
					var pref = document.getElementById("pref"+id).innerHTML;
					if(document.getElementById("is_allowed"+id).checked){
						is_allowed=1;
					}
					if(document.getElementById("insert"+id).checked){
						isinsert=1;
					}
					if(document.getElementById("edit"+id).checked){
						isedit=1;
					}
					if(document.getElementById("delete"+id).checked){
						isdelete=1;
					}
					if(document.getElementById("search"+id).checked){
						issearch=1;
					}
					if(document.getElementById("print"+id).checked){
						isprint=1;
					}
					if(document.getElementById("approve"+id).checked){
						isapprove=1;
					}
					if(document.getElementById("default"+id).checked){
						is_default=1;
					}
					//if(is_allowed==1){
					$.ajax
					({
						type:'post',
						url:'dal/dal_loginpage.php',
						data:{
							save_details:'save_details',
							menu:menu,
							menu_link:menu_link,
							menu_ref:menu_ref,
							menu_text:menu_text,
							pref:pref,
							is_allowed:is_allowed,
							isinsert:isinsert,
							isedit:isedit,
							isdelete:isdelete,
							issearch:issearch,
							isprint:isprint,
							isapprove:isapprove,
							is_default:is_default,
							user_id:user_id,
						},success:function(response) {
							debugger;
							ajax_complete++;
							if(ajax_complete ==row_no-2){
								location.reload();
							}
						}
					})
					//}
				}
		}
	})
}