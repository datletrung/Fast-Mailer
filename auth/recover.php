<!DOCTYPE html>
<html>
<head>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Fast Mailer</title>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="../assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">				
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
	return vars;
}	

function check_token(){
	var token="";
	token = getUrlVars()["token"];
	if(token==""){
		window.location.href="/auth";
	}
	return token;
}
	
function clicked(){
 $("#error").html("<center><p1>Please wait...</p1></center>");
 var pass=$("#pass").val();
 var passc=$("#passc").val();
 var token=check_token();
 //console.log(token);
 if(pass!="" && passc!="")
 {
  if (pass!==passc)
  {
   $("#error").html("<center><p>Password and confirmation password do not match.</p></center>");
  }else{
  $("#loading_spinner").css({"display":"block"});
  $.ajax
  ({
  type:'post',
  url:'reset-password.php',
  dataType: "json",
  data:{
   submit:"submit",
   password:pass,
   token:token   
  },
  success:function(data){
  console.log(data.status);
  if(data.status == 'ok'){
    window.location.href="/auth";
  }
  else if(data.status == 'error')
  {
    $("#loading_spinner").css({"display":"none"});
	$("#error").html("<center><p>Something went wrong! Please try again later.</p></center>");
  } else if(data.status == 'error1')
  {
    $("#loading_spinner").css({"display":"none"});
	$("#error").html("<center><p>Invaid token.</p></center>");
  }
  }
  });
 }
 }else{
    $("#error").html("<center><p>Please enter full information.</p></center>");
 }

 return false;
}
window.onload = check_token();
</script>
</head>
<body>
<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">New Password</label>
	<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
	<div class="login-form">      
		<div class="sign-in-htm">
			<form method="post" action="" onsubmit="return clicked();">
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="passc" name="passc" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input type="submit" name="recover" class="button" value="Change password">
				</div>
				<div id="error"></div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href='/auth'>Sign in</a>
				</div>
			</form>
		</div>
	</div>
  </div>
</div>
</body>
</html>