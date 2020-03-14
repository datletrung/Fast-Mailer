

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
	return vars;
}
function login(){
 $("#error1").html("<center><p1>Please wait...</p1></center>");
 var next = getUrlVars()["next"];
 //console.log(next);
 var user=$("#user").val();
 var pass=$("#pass").val();
 if(user!="" && pass!="")
 {
  $("#loading_spinner").css({"display":"block"});
  $.ajax
  ({
  type:'post',
  url:'login.php',
  dataType: "json",
  data:{
   login:"login",
   username:user,
   password:pass,
   next:next
  },
  success:function(data){
  console.log(data.status);
  if(data.status == 'ok'){
    window.location.href="redirect.php";
  }
  else if(data.status == 'error')
  {
    $("#loading_spinner").css({"display":"none"});
	$("#error1").html("<center><p>Wrong Username or Password.</p></center>");
  } else if(data.status == 'error1')
  {
    $("#loading_spinner").css({"display":"none"});
	$("#error1").html("<center><p>You have to verify your account first.</br>Check your email inbox.</p></center>");
  }else
  {
    window.location.href=data.status;
  }
  }
  });
 }

 else
 {
    $("#error1").html("<center><p>Please enter full information.</p></center>");
 }

 return false;
}

function register(){
 $("#error2").html("<center><p1>Please wait...</p1></center>");
 var displayname=$("#displayname").val();
 var user=$("#user1").val();
 var pass=$("#pass1").val();
 var passc=$("#passc").val();
 var email=$("#email").val();
 if(email!="" && user!="" && pass!="" && passc!="" && email!="")
 {
  if(pass!=passc){
  $("#error2").html("<center><p>Password and confirmation password do not match.</p></center>");
  }else if(validateEmail(email) == false){
  $("#error2").html("<center><p>Invalid email address.</p></center>");
  }else if (document.getElementById("tos").checked == false){
  $("#error2").html("<center><p>Please accept our Terms Of Service!</p></center>");
  }else{
  $("#loading_spinner").css({"display":"block"});
  $.ajax
  ({
  type:'post',
  url:'register.php',
  dataType: "json",
  data:{
   register:"register",
   displayname:displayname,
   username:user,
   password:pass,
   email:email
  },
  success:function(data){
  //console.log(data.status);
  console.log(data);
  if(data.status == 'error'){ 
	$("#loading_spinner").css({"display":"none"});
	$("#error2").html("<center><p>Username or Email already exists.</p></center>");
  }
  else if(data.status == 'error1'){ 
	$("#loading_spinner").css({"display":"none"});
	$("#error2").html("<center><p>Something went wrong! Please try again later.</p></center>");
  }
  else if(data.status == 'ok'){
	document.getElementById('user1').value = '';
	document.getElementById('pass1').value = '';
	document.getElementById('passc').value = '';
	document.getElementById('email').value = '';
	document.getElementById('displayname').value = '';
	document.getElementById("tab-1").checked = true;
	$("#error2").html("");
	$("#error1").html("<center><p1>Account created!</p1></br><p1>Check your email inbox to verify your account.</p1></center>");
  }
  }
  });
  }
 }

 else
 {
  $("#error2").html("<center><p>Please enter full information.</p></center>");
 }
 return false;
}