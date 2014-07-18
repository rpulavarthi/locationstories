$("#individual_info").live("pagecreate",function() {
		          $("#individualinfo_submit").click(check_individualinfo);
		      });
			function check_individualinfo()
			{
				var firstname = $("#firstname").val();
				var lastname = $("#lastname").val();
				var email_address = $("#email_address").val();
				var pass = true;
				if(firstname == "")
				{
					$("#firstname").css({'border':'2px solid #F7730E'});
					pass = false;
				}
				else
				{
					$("#firstname").css({'border':'1px'});
				}
				if(lastname == "")
				{
					$("#lastname").css({'border':'2px solid #F7730E'});
					pass = false;
				}
				else
				{
					$("#lastname").css({'border':'1px'});
				}
				if(email_address == "")
				{
					$("#email_address").css({'border':'2px solid #F7730E'});
					pass = false;
				}
				else
				{
					$("#email_address").css({'border':'1px'});
				}
				if(pass)
				{
					window.location = "#registration";
				}
				else
				{
					$("#individual_info").simpledialog2({
						    mode: 'blank',
						    headerText: 'Missing info',
						    headerClose: false,
						    blankContent : 
						      "<label>Please fill out missing fields</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
				}
			}