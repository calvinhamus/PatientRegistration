var url = "http://web/~plee/PatientRegistration/api/";
//var url = "http://localhost/slim/";
var nurse = 0;
var doc = 0;
var facility = 0;
var patient = 0;

  $(document).ready(function ()
			{
			jQuery('#datetimepicker3').datetimepicker();

               // var selectBox = document.getElementById("datetimepicker3");
             //  getFacilities();
               getNurses();
               getPatients();
			   getDoctorsByFacility();
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
          url: url +'facilities'
       //   context: document.body
        }).done(function(data) {
        var headers=[ ""], rows={}
             headers.push("Status");
             if(data.responseCode == 200)
             {
              $.each(data.data.facilities,function(i,obj)
                                    {
                                    // alert(obj[i].value+":"+obj[i].text);
                                    //var div_data = "<li role='presentation'> <a href='#' tabindex='-1' onclick='getDoctorsByFacility("+obj.OrganizationId+")'>"+obj.OrganizationName+ "</a></li>"
                                     var div_data = "<option value='"+obj.OrganizationId+"'>"+obj.OrganizationName+"</option>";
                                    //alert(div_data);
                                    $(div_data).appendTo('#assignLocationDrop');
                                    });
             }

        });

            }catch(err){
            			alert(err);
            }
}
function getDoctorsByFacility()
{
//facility = $i;
   // var selectBox = document.getElementById("assignLocationDrop");
  //  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		try{

            $.ajax({
              url: url +'doctors'
           //   context: document.body
            }).done(function(data) {
            var headers=[ ""], rows={}
                 headers.push("Status");
                 if(data.responseCode == 200)
                 {
                  $.each(data.data.doctors,function(i,obj)
                                        {
                                        // alert(obj[i].value+":"+obj[i].text);
                                        //  var div_data = "<li role='presentation'> <a href='#' tabindex='-1' onclick='setDoc("+obj.PersonId+")'>"+obj.FirstName+ ' ' + obj.LastName+"</a></li>"
                                         var div_data = "<option value='"+obj.PersonId+"'>"+obj.FirstName+ ' ' + obj.LastName+"</option>";
                                        //alert(div_data);
                                        $(div_data).appendTo('#assignDocDrop');
                                        });
                 }else{
                      var div_data = "<option>No Doctors Found at that location</option>";
                                    $(div_data).appendTo('#assignDocDrop');
                                 //alert('No nurses found');
                 }

            });

                }catch(err){
                			alert(err);
                }
}
function setDoc(data)
{
   var selectBox = document.getElementById("datetimepicker3");
    doc = data;
}
function getNurses()
 {
 try{

         $.ajax({
           url: url +'nurses'
        //   context: document.body
         }).done(function(data) {
         var headers=[ ""], rows={}
              headers.push("Status");
              if(data.responseCode == 200)
              {
               $.each(data.data.nurses,function(i,obj)
                                     {

                                     // alert(obj[i].value+":"+obj[i].text);
                                      var div_data = "<option value='"+obj.PersonId+"'>"+obj.FirstName+ ' ' + obj.LastName+ "</option>";
                                     // var div_data = "<li role='presentation'> <a role='menuitem' tabindex='-1' onclick='setNurse("+obj.PersonId+")'>"+obj.FirstName+ ' ' + obj.LastName+ "</a></li>"
                                     //alert(div_data);
                                     $(div_data).appendTo('#assignNurseDrop');
                                     });
              }else {
                var div_data = "<option>No Nurses Found at that location</option>";
                 $(div_data).appendTo('#assignNurseDrop');
              alert('No nurses found');
              }

         });

             }catch(err){
             			alert(err);
             }
 }
function setNurse(data)
{
    nurse = data;
}
 function getPatients()
  {
   	try{

     $.ajax({
       url: url +'patients'
    //   context: document.body
     }).done(function(data) {
     var headers=[ ""], rows={}
          headers.push("Status");
          if(data.responseCode == 200)
          {
           $.each(data.data.patients,function(i,obj)
                                 {
                                 // alert(obj[i].value+":"+obj[i].text);
                                    var div_data = "<option value='"+obj.PersonId+"'>"+obj.FirstName+ ' ' + obj.LastName+"</option>";
                                  //var div_data = "<li role='presentation'> <a href='#' tabindex='-1'>"+obj.FirstName+ ' ' + obj.LastName+"</a></li>"
                                 //alert(div_data);
                                 $(div_data).appendTo('#patientDrop');
                                 });
          }

     });

         }catch(err){
         			alert(err);
         }
  }
  function setPatient(data)
  {
    patient = data;
  }
  function createAppointment()
{
var time = document.getElementById("datetimepicker3").value;
    if(nurse == 0|| doc == 0 || patient == 0 || time == "" )
     {
        alert("Please select all options");
     }else
     {
          try{
                   $.ajax({
                   type:"POST",
                     url: url +'appointment',
                     data: 'dateTime=' + time +'&patientId='+ patient + '&nurseId=' + nurse + '&doctorId=' + doc 
                  //   context: document.body
                   }).done(function(data) {
                   var headers=[ ""], rows={}
                        headers.push("Status");
                        if(data.responseCode == 200)
                        {
                        alert('Success');
                     
                        }else if(data.responseCode == 224){
                             alert('Time slot taken');
                        }
                        else
                        {
                            alert('Oh no failure');
                        }

                   });

                       }catch(err){
                       			alert(err);
                       }
     }

  }

