	var lat= 0;
	var lng = 0;
	var fname;
	var lname;
	var email_address;
	
	var business_name;
	var business_category;
	var business_email;
	var business_website;
	var business_locations = [];
	
	var acct;
		$("#registration").live("pagecreate",function() 
		{
          $("#signup").click(signup);
          fname = $("#firstname").val();
          if(fname != "")
          {
          	acct = "individual";
          	lname = $("#lastname").val();
          	email_address = $("#email_address").val();
          }
          else
          {
          	business_name = $("#businessname").val();
          	business_category = $("#categories  option:selected").val();
          	business_email = $("#email").val();
          	business_website = $("#website_link").val();
          	//fill locations
          	$("#branch_locations_list li a").each(function(){
          		business_locations.push({formatted_address:$(this).attr("formatted_address")});
          });
          	acct = "business";
          }
      	});

		function signup()
		{
			var user_name = $("#username").val();
			var pwd = $("#pwd").val();
			var pwd_c = $("#pwd_c").val();
			var pass = true;
			if(user_name == "")
			{
				$("#username").css({'border':'2px solid #F7730E'});
				pass = false;
			}
			else
			{
				$("#username").css({'border':'1px'});
			}
			if(pwd == "")
			{
				$("#pwd").css({'border':'2px solid #F7730E'});
				pass = false;
			}
			else
			{
				$("#pwd").css({'border':'1px'});
			}
			
			if(pwd_c == "")
			{
				$("#pwd_c").css({'border':'2px solid #F7730E'});
				pass = false;
			}
			else
			{
				$("#pwd_c").css({'border':'1px'});
			}
			
			if(pass)
			{
				if(pwd == pwd_c)
				{
					var pwd_md5 = CryptoJS.MD5(pwd).toString();
					$.get("check/"+userid,function(data, status){
						if(data == "yes")
						{
							$("#registration").simpledialog2({
						    mode: 'blank',
						    headerText: 'Username',
						    headerClose: false,
						    blankContent : 
						      "<label>Sorry, Username already exists !!</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
							$("#userid").css({'border':'2px solid #F7730E'});
						}
						else
						{
							var url;
							var params;
							if(acct =="individual")
							{
								url = "create/username/individual";
								params = { username: user_name, password: pwd_md5, 
								firstname:fname, lastname:lname, latitude:lat,
								longitude:lng, email:email_address };
								$.post(url, 
								params, function(data)
									{
										var status = data.split(":")[0];
										if(status == "Success")
										{
											window.location = "#confirmation";	
										}
										else if(status == "Error")
										{
											window.location = "#failure";
										}
									});
							}
							else if(acct == "business")
							{
								 url= "create/username/business";
								 var json_locations = JSON.stringify(business_locations);
								 params = { username: user_name, password: pwd_md5, 
								 businessname:business_name, categoryId:business_category, 
								 email:business_email,website:business_website,
								 locations: json_locations };
								 $.post(url, params, function(data)
									{
											var status = data.split(":")[0];
											if(status == "Success")
											{
												window.location = "#confirmation";	
											}
											else if(status == "Error")
											{
												window.location = "#failure";
											}
									});
							}
							
						}
					});
					
				}
				else
				{
					$("#registration").simpledialog2({
						    mode: 'blank',
						    headerText: 'Passwords',
						    headerClose: false,
						    blankContent : 
						      "<label>Passwords do not match</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
						 
					$("#pwd").css({'border':'2px solid #F7730E'});
					$("#pwd_c").css({'border':'2px solid #F7730E'});
				}
			}
			else
			{
				$("#registration").simpledialog2({
						    mode: 'blank',
						    headerText: 'Missing info',
						    headerClose: false,
						    blankContent : 
						      "<label>Please fill out missing fields</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
			}
			
		}