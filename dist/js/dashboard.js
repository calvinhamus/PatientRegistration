  $(document).ready(function () 
			{ 
                $('#example1').datepicker()
				.on('changeDate', function(ev){
				  				
            
					});
			});

/*onload = function() {
    	var url = document.URL;
		getProcessingTime();
		getQueueDepth();
};

function getNurses(data)
{
	try{

$.ajax({
  url: BASE_URL + 'monitor/errors/'+data ,
  context: document.body
}).done(function(data) {
var headers=[ ""], rows={}
     headers.push("Status");
   $.each(data,function(clientIdx,item){
		rows[clientIdx] = "<b>"+item.code+"</b>" + "        " + item.time
	   

  })
  var rowHtml='<tr><th>'+headers.join('</th><th>')+'</th></tr>';
  $.each(rows,function(key, arr){
    rowHtml+='<tr><td>'+key+'</td>';
    rowHtml +='<td>'+arr+' '+'</td><td>'+'</td></tr>';
	$('#statusTable').html(rowHtml);
  })
});
 
    }catch(err){
    			alert(err);
    }
}

function getDocs(data)
{
	try{

$.ajax({
  url: BASE_URL + 'monitor/errors/'+data ,
  context: document.body
}).done(function(data) {
var headers=[ ""], rows={}
     headers.push("Status");
   $.each(data,function(clientIdx,item){
		rows[clientIdx] = "<b>"+item.code+"</b>" + "        " + item.time
	   

  })
  var rowHtml='<tr><th>'+headers.join('</th><th>')+'</th></tr>';
  $.each(rows,function(key, arr){
    rowHtml+='<tr><td>'+key+'</td>';
    rowHtml +='<td>'+arr+' '+'</td><td>'+'</td></tr>';
	$('#statusTable').html(rowHtml);
  })
});
 
    }catch(err){
    			alert(err);
    }
}*/