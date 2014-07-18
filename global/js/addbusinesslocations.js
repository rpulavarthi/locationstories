var location_items= [];

$("#add_branches").live("pagecreate",function() 
{
 	var autocomplete = new google.maps.places.Autocomplete($("#branch_address")[0], {});

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
    	var place = autocomplete.getPlace();
    });
    
    $("#branch_location_submit").live("click", function(){
    	if(location_items.length == 0)
    	{
    		$("#add_branches").simpledialog2({
						    mode: 'blank',
						    headerText: 'Missing info',
						    headerClose: false,
						    blankContent : 
						      "<label>Please add atleast one business location to proceed further!!</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
    	}
    	else
    	{
    		window.location = "#registration";
    	}
    });
    
    $("#branch_location_add").live( "click", function() {
 			var parent = document.getElementById('branch_locations_list');
 			var address_added= $("#branch_address").val();
 			contains = false;
 			$.each(location_items, function(value){
 				if(String($.trim(location_items[value].formatted_address)) == String($.trim(address_added)))
 				{
 					contains = true;
 					$("#add_branches").simpledialog2({
						    mode: 'blank',
						    headerText: 'Duplicate',
						    headerClose: false,
						    blankContent : 
						      "<label>Address already exists!!</label>"+
						      "<a rel='close' data-theme='a' data-role='button' href='#'>Close</a>"
						 });
 					return false;
 				}
 			});
 			if(!contains)
 			{
 				location_items.push({"formatted_address":address_added});
	            var listItem = document.createElement('li');
	            listItem.setAttribute('id','listitem');
	            listItem.innerHTML = "<a formatted_address=\""+address_added+"\" href='#'>"+address_added+"</a>";
	            parent.appendChild(listItem);
	            var list = document.getElementById('branch_locations_list');
	            $(list).listview("refresh");
           	}
 	});
 
});