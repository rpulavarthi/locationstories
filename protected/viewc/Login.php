<!DOCTYPE html> 
<html> 
	<head> 
	<title>Location Stories</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	<script type="text/javascript" src="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog2.min.js"></script>
</head> 
<body> 

<!-- Login Page -->
<div data-role="page" id="loginpage">
	<script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/rollups/md5.js">
		
	</script>
	<script src="global/js/authentication.js">
		
	</script>
	<div data-role="header" data-theme="a">
		<h1>Location Stories</h1>		
	</div>
	<div data-role="content">	
		<form>
			<a id="register" href="#select_accounttype" data-role="button">Not a member yet? Signup</a><br /> 
			<label>User Id</label>
			<input id="userid" type="text" /><br/>
			<label>Password</label>
			<input id="password" type="password" /><br/>
			<a id="login" data-role="button">Login</a>
		</form>	
	</div>
</div>

<!-- Select account type -->
<div data-role="page" id="select_accounttype" data-add-back-btn="true" data-back-btn-text="Login">
			<div data-role="header">
				<h1>Select Account Type</h1>		
			</div>
			<div data-role="content">
				<br/>
				<a id="individual" href="#individual_info" data-role="button">Individual</a>
				<a id="business" href="#business_info" data-role="button">Business</a>
			</div>
		</div>

<!-- Collect business info -->		
<div data-role="page" id="business_info" data-add-back-btn="true" data-back-btn-text="Back">
	<script src="global/js/businessinfo.js">
		
	</script>
	<div data-role="header">
		<h1>Registration - Step 1 of 3</h1>	
	</div>
	<div data-role="content">
				<label>Name of business</label>
				<input id="businessname" type="text" />
				<select id="categories" data-mini="true" data-native-menu="false">
					<option selected>Choose a category</option>
					<?php
					$categoryNames = $this->data['categoryNames'];
							$categoryIds = $this->data['categoryIds'];
							$i = 0;
							foreach($categoryIds as $categoryId)
							{
								$categoryName =$categoryNames[$i];
								echo "<option value=$categoryId>$categoryName</option>";
								$i++;
							}
					?>
				</select><br />
				<label>Email address</label>
				<input id="email" type="text" />
				<label>Website (Optional)</label>
				<input id="website_link" type="text" /><br/>
				<a id="businessinfo_submit" data-role="button">Next</a>
	</div>
</div>

<!-- Collect individual's info -->		
<div data-role="page" id="individual_info" data-add-back-btn="true" data-back-btn-text="Back">
	<script src="global/js/individualinfo.js">
		
	</script>
	<div data-role="header">
		<h1>Registration - Step 1 of 2</h1>	
	</div>
	<div data-role="content">
				<label>First name</label>
				<input id="firstname" type="text" /><br/>
				<label>Last name</label>
				<input id="lastname" type="text" /><br/>
				<label>Email address</label>
				<input id="email_address" type="text" /><br/>
				<a id="individualinfo_submit" data-role="button">Next</a>
				
	</div>
</div>

<!-- Collect business locations -->		
<div data-role="page" id="add_branches" data-add-back-btn="true" data-back-btn-text="Back">
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=en-AU"></script>
	<script src="global/js/addbusinesslocations.js"></script>
	<div data-role="header" >
	<h1>Registration - Step 2 of 3</h1>		
	</div>
	<div data-role="content">	
		<input id="branch_address" type="text" /><br/>
		<a id="branch_location_add" data-role="button">Add location</a>
		<a id="branch_location_submit" data-role="button">Done - Next</a><br/><br/>
	    <ol id="branch_locations_list" data-role="listview"></ol>
	</div>
</div>

<!-- Final registration step -->		
<div data-role="page" id="registration" data-add-back-btn="true" data-back-btn-text="Back">
	<script src="global/js/registration.js">
	
	</script>
	<div data-role="header" >
	<h1>Almost Done!!</h1>		
	</div>
	<div data-role="content">	
		<form>
			<label>User Id</label>
			<input id="username" type="text" /><br/>
			<label>Password</label>
			<input id="pwd" type="password" /><br/>
			<label>Confirm password</label>
			<input id="pwd_c" type="password" /><br/>
			<a id="signup" data-role="button">Sign up</a>
		</form>	
	</div>
</div>

<!-- Confirmation page -->
<div data-role="page" id="confirmation">
	<div data-role="header" >
		<h1>Complete</h1>		
	</div>
	<div data-role="content">	
		<form>
			<p>Congratulations. Your account has been created.</p>
			<a href="#loginpage" data-role="button">Proceed to login</a>
		</form>	
	</div>
</div>

<!-- Failure indication page -->
<div data-role="page" id="failure">
	<div data-role="header" >
		<h1>Failed</h1>		
	</div>
	<div data-role="content">	
		<form>
			<p>Sorry, your registration could not be completed at this time. Please try again later.</p>
			<a href="login" data-role="button">Go to Login</a>
		</form>	
	</div>
</div>

</body>
</html>