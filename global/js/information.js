$(document).ready(init);
		
function init()
{
	$("#next").click(validate);
	$("#individual").click(individual_layout);
	$("#business").click(business_layout);
	//$("#info_div").load('info/individual');
}


function validate()
{
	
}

function individual_layout()
{
	$.get('info/individual').success(function(data)
 	{
 		$("#info_div").html(data);
 	});
	
}

function  business_layout()
{
	$.get('info/business').success(function(data)
 	{
 		$("#info_div").html(data);
 	});
}
