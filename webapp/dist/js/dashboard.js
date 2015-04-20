  $(document).ready(function () 
			{ 
                $('#example1').datepicker()
				.on('changeDate', function(ev){
				 var url = document.URL;
            
					});
			});


/*onload = function() {
    	var url = document.URL;
		getProcessingTime();
		getQueueDepth();
};*/
function getFacilities()
{
	try{

$.ajax({
  url: BASE_URL + 'monitor/errors/'+data ,
  context: document.body
}).done(function(data) {
var headers=[ ""], rows={}
     headers.push("Status");
   $.each(data.data,function(i,obj)
                   {
                    alert(obj.value+":"+obj.text);
                    var div_data = "<li role='presentation'><a role='menuitem' tabindex='-1' onclick='getDoctorsByFacility(obj.id)'>"+obj.data+"</a></li>"
                   alert(div_data);
                   $(div_data).appendTo('#locationDropDown');
                   });
});

    }catch(err){
    			alert(err);
    }
}
function getDoctorsByFacility(data)
{
	try{

$.ajax({
  url: BASE_URL + 'monitor/errors/'+data ,
  context: document.body
}).done(function(data) {
var headers=[ ""], rows={}
     headers.push("Status");
   $.each(data.data,function(i,obj)
                   {
                    alert(obj.value+":"+obj.text);
                    var div_data = "<li role='presentation'><a role='menuitem' tabindex='-1' onclick='getNurses()'>"+obj.FirstName+ ' ' + obj.LastName"</a></li>"
                   alert(div_data);
                   $(div_data).appendTo('#doctorDropDown');
                   });
});

    }catch(err){
    			alert(err);
    }
}
function getNurses(data)
 {
 	try{

 $.ajax({
   url: BASE_URL + 'monitor/errors/'+data ,
   context: document.body
 }).done(function(data) {
 var headers=[ ""], rows={}
      headers.push("Status");
    $.each(data.data,function(i,obj)
                    {
                     alert(obj.value+":"+obj.text);
                     var div_data = "<li role='presentation'><a role='menuitem' tabindex='-1' onclick='assignNurseToDoc()'>"+obj.FirstName+ ' ' + obj.LastName"</a></li>"
                    alert(div_data);
                    $(div_data).appendTo('#nurseDropDown');
                    });
 });

     }catch(err){
     			alert(err);
     }
 }

 function assignNurseToDoc(data)
 {
 var location = document.getElementById('assignLocationDrop').value;
 var doc = document.getElementById('assignDocDrop').value;
 var location = document.getElementById('assignNurseDrop').value;
 	try{

 $.ajax({
   url: BASE_URL + 'monitor/errors/'+data ,
   context: document.body
 }).done(function(data) {
 var headers=[ ""], rows={}
      headers.push("Status");
    $.each(data.aaData,function(i,obj)
                    {
                     alert(obj.value+":"+obj.text);
                     var div_data = "<li role='presentation'><a role='menuitem' tabindex='-1' onclick='getDoctorsByFacility(obj.id)'>"+obj.data+"</a></li>"
                    alert(div_data);
                    $(div_data).appendTo('#nurseDropDown');
                    });
 });

     }catch(err){
     			alert(err);
     }
 }
 /****Page 2******/

 function getPatients()
  {
  	try{

  $.ajax({
    url: BASE_URL + 'monitor/errors/'+data ,
    context: document.body
  }).done(function(data) {
  var headers=[ ""], rows={}
       headers.push("Status");
     $.each(data.data,function(i,obj)
                     {
                      alert(obj.value+":"+obj.text);
                      var div_data = "<li role='presentation'><a role='menuitem' tabindex='-1'>"+obj.FirstName+ ' ' + obj.LastName"</a></li>"
                     alert(div_data);
                     $(div_data).appendTo('#nurseDropDown');
                     });
  });

      }catch(err){
      			alert(err);
      }
  }

   function getDoctors()
    {
    	try{

    $.ajax({
      url: BASE_URL + 'monitor/errors/'+data ,
      context: document.body
    }).done(function(data) {
    var headers=[ ""], rows={}
         headers.push("Status");
       $.each(data.data,function(i,obj)
                       {
                        alert(obj.value+":"+obj.text);
                        var div_data = "<li role='presentation'><a role='menuitem' tabindex='-1' >"+obj.FirstName+ ' ' + obj.LastName"</a></li>"
                       alert(div_data);
                       $(div_data).appendTo('#nurseDropDown');
                       });
    });

        }catch(err){
        			alert(err);
        }
    }

   function assignPatientToTime()
    {
     var patient = document.getElementById('patientDrop').value;
     var doc = document.getElementById('doctorDrop').value;
     var doc = document.getElementById('doctorDrop').value;//TODO This
        try{

    $.ajax({
      url: BASE_URL + 'monitor/errors/'+data ,
      context: document.body
    }).done(function(data) {
    var headers=[ ""], rows={}
         headers.push("Status");
       $.each(data.aaData,function(i,obj)
                       {
                        alert(obj.value+":"+obj.text);
                        var div_data = "<li role='presentation'><a role='menuitem' tabindex='-1' >"+obj.data+"</a></li>"
                       alert(div_data);
                       $(div_data).appendTo('#nurseDropDown');
                       });
    });

        }catch(err){
                    alert(err);
        }
    }
