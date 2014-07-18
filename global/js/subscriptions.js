var _this;

$("#addSubscriptions").live("pagecreate",function() 
{
	var timeoutReference;
	$("#search-basic").keypress(function(){
		_this = $(this); 
        if (timeoutReference) clearTimeout(timeoutReference);
        timeoutReference = setTimeout(_callback, 1000);
    	});
});

function _callback()
{
	 var search = _this.val();
	 var url = "subscriptions/get";
	 var params = {keywords:search}
	 $.get(url,params, function(data, status)
	 {
	 	if(status == "success")
	 	{
	 		var list = document.getElementById('subscription_results');
	 		$('#subscription_results').children().remove('li');
	 		if(data != "")
	 		{
	 			var json_data = JSON.parse(data);
	 			for(var i=0;i<json_data.length;i++)
	 			{
	 				var listdiv = document.createElement('li');
			 		listdiv.innerHTML = "<a>"+json_data[i]['businessname']+"</a><a></a>";
			 		list.appendChild(listdiv);	
	 			}
	 		}
	 		$(list).listview("refresh");
	 	}
	 })
}
