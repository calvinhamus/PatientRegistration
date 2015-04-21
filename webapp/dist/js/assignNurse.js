var url = "http://localhost/slim/";
var nurse = 0;
var doc = 0;
var facility = 0;
  $(document).ready(function ()
			{
               getFacilities();
               getNurses();
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
                                     var div_data = "<li role='presentation'> <a href='#' tabindex='-1' onclick='getDoctorsByFacility("+obj.OrganizationId+")'>"+obj.OrganizationName+ "</a></li>"
                                    //alert(div_data);
                                    $(div_data).appendTo('#locationDropDown');
                                    });
             }

        });

            }catch(err){
            			alert(err);
            }
}
function getDoctorsByFacility(data)
{
facility = data;
		try{

            $.ajax({
              url: url +'doctors?facilityId='+data
           //   context: document.body
            }).done(function(data) {
            var headers=[ ""], rows={}
                 headers.push("Status");
                 if(data.responseCode == 200)
                 {
                  $.each(data.data.doctors,function(i,obj)
                                        {
                                        // alert(obj[i].value+":"+obj[i].text);
                                          var div_data = "<li role='presentation'> <a href='#' tabindex='-1' onclick='setDoc("+obj.PersonId+")'>"+obj.FirstName+ ' ' + obj.LastName+"</a></li>"
                                        //alert(div_data);
                                        $(div_data).appendTo('#doctorDropDown');
                                        });
                 }else{
                    alert('No Doctors found at this facility');
                 }

            });

                }catch(err){
                			alert(err);
                }
}
function setDoc(data)
{
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
                                      var div_data = "<li role='presentation'> <a role='menuitem' tabindex='-1' onclick='setNurse("+obj.PersonId+")'>"+obj.FirstName+ ' ' + obj.LastName+ "</a></li>"
                                     //alert(div_data);
                                     $(div_data).appendTo('#nurseDropDown');
                                     });
              }else {
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
 function assignNurseToDoc()
 {
 if(nurse == 0|| doc == 0 || facility == 0)
 {
    alert("select all three options");
 }else
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
                                        var div_data = "<li role='presentation'> <a role='menuitem' tabindex='-1' onclick='setNurse("+obj.PersonId+")'>"+obj.FirstName+ ' ' + obj.LastName+ "</a></li>"
                                       //alert(div_data);
                                       $(div_data).appendTo('#nurseDropDown');
                                       });
                }else {
                alert('No nurses found');
                }

           });

               }catch(err){
               			alert(err);
               }
 }

 }
 $(".dropdown-menu li a").click(function(){
   var selText = $(this).text();
   $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
 });
