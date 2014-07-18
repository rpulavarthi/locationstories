$("#business_info").live("pagecreate",function() {
					$("#businessinfo_submit").click(check_businessinfo);
			      });
			     
			    function check_businessinfo()
				{
					var businessname = $("#businessname").val();
					var email = $("#email").val();
					var pass = true;
					if(businessname == "")
					{
						$("#businessname").css({'border':'2px solid #F7730E'});
						pass = false;
					}
					else
					{
						$("#businessname").css({'border':'1px solid'});
					}
					if($("#categories").prop("selectedIndex") == 0)
					{
						$("#categories").css({'border':'2px solid #F7730E'});
						pass = false;
					}
					else
					{
						$("#categories").css({'border':'1px solid'});
					}
					if(email == "")
					{
						$("#email").css({'border':'2px solid #F7730E'});
						pass = false;
					}
					else
					{
						$("#email").css({'border':'1px solid'});
					}
					if(pass)
					{
						window.location = "#add_branches";
					}
					else
					{
						$("#business_info").simpledialog2({
						    mode: 'blank',
						    headerText: 'Missing info',
						    headerClose: false,
						    blankContent : 
						      "<label>Please fill out missing fields</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
				  
					}
				}