window.created = false;

function copy(){
  if (created){
	var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(document.getElementById("usermail"));
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand("Copy");
    selection.removeAllRanges();
    //alert("Copied: "+document.getElementById("usermail").textContent);
	document.getElementById('myPopup').style.display = "";
	setTimeout(function() {
		//popup.classList.toggle('hide');
		document.getElementById('myPopup').style.display = "none";
	}, 3000);
  }
}

function create(){
$("#noti").html("");
document.getElementById("result").style.display = "none";
document.getElementById("refresh").style.display = "none";
document.getElementById("msg").style.display = "none";
if (created){
 console.log("delete");
 $("#loading_spinner").css({"display":"block"});
 $.ajax({
  type:'post',
  url:'delete.php',
  dataType: "json",
  data:{
   submit:"submit",
   user:user
  },
  success:function(data){
	if(data.status == 'ok'){
		console.log(data);
	}else{
		created = 'error';
		$("#noti").html("<p>Unable to create new email! Please try again later!</p>");
		
	}
  }
 });
}
 $("#loading_spinner").css({"display":"block"});
 $.ajax({
  type:'post',
  url:'create.php',
  dataType: "json",
  data:{
   submit:"submit"
  },
  success:function(data){
	//console.log(data);
	if(data.status == 'ok' && created != 'error'){
		window.user = data.user;
		created = true;
		update();
		$("#noti").html("Your email address is: <i><b class='popup' id='usermail'>"+user+"@mail.tdkiller.tk <span class='popuptext' id='myPopup' style='display:none'>Copied!</span></b></i> <button class='button' id='button' type='button' onclick='copy();'>Copy</button>");
	}else{
		created = false;
		$("#noti").html("<p>Unable to create new email! Please try again later!</p>");
	}
  }
  });
}

function detail(id){
	//$('.'+id).toggle()
	$("#loading_spinner").css({"display":"block"});
	if (document.getElementById(id).style.display == "none"){
		document.getElementById(id).style.display = "";
	}else{
		document.getElementById(id).style.display = "none";
	}
}

function update(){
if (created){
 document.getElementById("result").style.display = "";
 document.getElementById("refresh").style.display = "";
 document.getElementById("msg").style.display = "";
 document.getElementById("refresh").style.width = "100%";
 $("#loading_spinner").css({"display":"block"});
 $.ajax({
  type:'post',
  url:'fetch.php',
  dataType: "json",
  data:{
   user:user
  },
  success:function(data){	
  $("#resulttable").html("<tr><th>Time</th><th>From</th><th>Subject</th></tr>"); 
  $("#msg").html("");
  //console.log(data);
  if(data.status == 'ok'){
	var id = 0;
	var arrayList = [];
	//console.log(data.detail);
	data = data.detail;
	data.forEach(function(data) {
        var id = data.id;
		var from = data.from;
        var subject = data.subject;
        var body = data.body;
        var time = data.time;
		var expand = "<img src='/assets/image/detail.png' title='Detail' width='15' height='15' style='float: right;' onclick='detail("+id+");'/>";
		$("#resulttable").append("<tr><td class='origin'>" + time + "</td><td class='origin'>" + from + "</td><td class='origin'>" + subject + expand + "</td></tr>");
		$("#resulttable").append("<tr style='display: none;' id='" + id + "'><td colspan='3' class='mailbody'>" + body + "</td></tr>");
	});
  }	
  else if(data.status == 'empty'){
    $("#loading_spinner").css({"display":"none"});
	$("#msg").html("<center><p>No email here!</p></center>");
  }
  }
  });
 return false;
}
}

window.onload = update();
jQuery().ready(function(){
	setInterval("update()",60000);
});