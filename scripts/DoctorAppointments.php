<?php
$host = "127.0.0.1:4655";
$user = "root";
$pass = "grad2015";
$dtbs = "AllTeam";

$link = mysql_connect($host, $user, $pass);
if (!$link){die('Could not connect: ' . mysql_error());}
mysql_select_db($dtbs);

if ($argc !== 4) {
	exit("usage is php DoctorAppointments.php '<DoctorsLastName>' '<facility name>' '<yyyy-dd-mm>'\n");
}

/* Parse the args
*/
$arg1 = $argv[1];
$arg2 = $argv[2];
$arg3 = $argv[3];

// Display a list of patients for a given Dr at a given facility on a given date
$sql = "select p.FirstName, p.LastName from Person p 
	where p.PersonId = 
	(select a.PersonId from Appointment a 
	where a.DoctorId = (select PersonId from Person where LastName = '{$arg1}') 
	and a.OrganizationId = (select OrganizationId from Organization where OrganizationName = '{$arg2}')
	and a.AppointmentDateTime like '{$arg3}%')";
$result = mysql_query($sql) or die('php failure - Unable to execute query! '.$sql);

echo "Patients for Dr ".$arg1." at ".$arg2." on ".$arg3."\n"; 
echo "-----------------------------------------------\n";

while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
 echo $row['FirstName']." ".$row['LastName']."\n";
}
mysql_free_result($result);
?>