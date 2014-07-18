$("#loginpage").live("pagecreate",function() 
{
	$("#login").click(login);
});

function login()
{
	var userid = $('#userid').val();
	var pwd = $('#password').val();
	var pass = true;
	if(userid == "")
	{
		$("#userid").css({'border':'2px solid #F7730E'});
		pass = false;
	}
	else
	{
		$("#userid").css({'border':'1px solid'});
	}
	if(pwd == "")
	{
		$("#password").css({'border':'2px solid #F7730E'});
		pass = false;
	}
	else
	{
		$("#password").css({'border':'1px solid'});	
	}
	if(pass)
	{
		var pwd_md5 =CryptoJS.MD5(pwd).toString();
		var url ="http://essargeo.com/locationstories/login";
		var params = {logintype:'username',username:userid,password:pwd_md5};
		console.log(params);
		$.get(url,params).done(function(data){
			var status = data.split(":")[0];
			if(status == "Success")
			{
				var user_id = data.split("-")[1];
				console.log(user_id);
				params = {userid:user_id};
				$.post("init_session",params).done(function(){
					window.location = "Login.html?userid="+user_id;
				});
			}
			else
			{
				$("#userid").css({'border':'2px solid #F7730E'});
				$("#password").css({'border':'2px solid #F7730E'});
				$("#registration").simpledialog2({
						    mode: 'blank',
						    headerText: 'Wrong',
						    headerClose: false,
						    blankContent : 
						      "<label>Incorrect username/password</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
			}
		});
	}
	else
	{
		$("#loginpage").simpledialog2({
						    mode: 'blank',
						    headerText: 'Missing info',
						    headerClose: false,
						    blankContent : 
						      "<label>Please fill out missing fields</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
	}
}


