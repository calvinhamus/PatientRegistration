 var url = "http://localhost/slim/"
  $(document).ready(function ()
			{ 
               /* $('#example1').datepicker()
				.on('changeDate', function(ev){
				 var url = document.URL;
            
					});*/
					getDoctors();
					getPatients();
			});
 /****Page 2******/
//DONE
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
                                  var div_data = "<li role='presentation'> <a href='#' tabindex='-1'>"+obj.FirstName+ ' ' + obj.LastName+"</a></li>"
                                 //alert(div_data);
                                 $(div_data).appendTo('#patientDropList');
                                 });
          }

     });

         }catch(err){
         			alert(err);
         }
  }
//DONE
   function getDoctors()
    {
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
                                 var div_data = "<li role='presentation'> <a href='#' tabindex='-1'>"+obj.FirstName+ ' ' + obj.LastName+"</a></li>"
                                //alert(div_data);
                                $(div_data).appendTo('#doctorDropList');
                                });
         }

    });

        }catch(err){
        			alert(err);
        }
    }
    function setDoctor(data)
    {
        alert(data);
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
                       // alert(obj.value+":"+obj.text);
                        var div_data = "<li role='presentation'><a role='menuitem' tabindex='-1' >"+obj[i].data+"</a></li>"
                       alert(div_data);
                       $(div_data).appendTo('#nurseDropDown');
                       });
    });

        }catch(err){
                    alert(err);
        }
    }
    $(".dropdown-menu > li > a").click(function(){
    alert('box');
     // var selText = $(this).text();
    //  $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
    });

 $('.table > tbody > tr').click(function() {
 alert('clicked');
     // row was clicked
 });
