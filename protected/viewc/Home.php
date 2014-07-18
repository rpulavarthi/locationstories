<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Location Stories</title>
		<link rel="stylesheet"  href="http://jquerymobile.com/demos/1.3.0-beta.1/css/themes/default/jquery.mobile-1.3.0-beta.1.css">
		<link rel="stylesheet" href="http://jquerymobile.com/demos/1.3.0-beta.1/docs/demos/_assets/css/jqm-demos.css">
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="http://jquerymobile.com/demos/1.3.0-beta.1/js/jquery.mobile-1.3.0-beta.1.js"></script>
	</head>
	<body>
		<div data-role="page" id="home-page" class="ui-responsive-panel">

			<div data-role="header" data-theme="a">
				<h1>Home</h1>
				<a href="#panel-left" data-icon="bars" data-iconpos="notext">Menu</a>
				<a href="#panel-right" data-icon="bars" data-iconpos="notext">Add</a>
			</div>
			<div data-role="content">
				
			</div>
			<div data-role="panel" data-position="left" data-position-fixed="false" data-display="push" id="panel-left" data-theme="a">

					<ul data-role="listview" data-theme="a" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
						<li data-icon="delete" style="background-color:#111;">
							<a href="#" data-rel="close">Close menu</a>
						</li>
						<li>
							<a href="logout">Sign out</a>
						</li>
					</ul>

				</div>
				<div data-role="panel" data-position="right" data-position-fixed="false" data-display="push" id="panel-right" data-theme="b">
					<div data-role="collapsible-set" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d">
					  <div data-role="collapsible" data-collapsed="false">
					    <h3>Subscriptions</h3>
					    <a href="#addSubscriptions" data-icon="plus" data-role="button">Add Subscription</a><br />
					  </div>
					  <div data-role="collapsible">
					    <h3>Buddies</h3>
					    <a href="#home" data-icon="plus" data-role="button">Add Buddy</a>
					  </div>
					  <div data-role="collapsible">
					    <h3>Invitations</h3>
					  </div>
					</div>
				</div>
		<script>
			 $(document).on( "swipeleft swiperight", "#home-page", function( e ) {
	        	if ( $.mobile.activePage.jqmData( "panel" ) !== "open" ) 
	        	{
		            if ( e.type === "swipeleft"  ) {
		                $( "#panel-right" ).panel( "open" );
		            } else if ( e.type === "swiperight" ) {
		                $( "#panel-left" ).panel( "open" );
	            	}
	        	}
	    	});	
    	</script>
		</div>
		
		<div data-role="page" id="addSubscriptions" data-add-back-btn="true" data-back-btn-text="Home">
			<script src="global/js/subscriptions.js">
		
			</script>
	
			<div data-role="header" data-theme="a">
				<h1>Add subscriptions</h1>
			</div>
			<div data-role="content">
				<label for="search-basic">Search by keywords:</label>
				<input type="text" name="search" id="search-basic" value="" /><br />
				<ul data-role="listview" id="subscription_results" data-split-icon="plus" data-split-theme="d" data-inset="true">
				  <li>
				  	<a>Acura</a>
				  	<a></a>
				  </li>
				  <li>
				  	<a>Audi</a>
				  	<a></a>
				  </li>
				  <li>
				  	<a>BMW</a><a></a>
				  </li>
				</ul>
			</div>
		</div>
	</body>
</html>
