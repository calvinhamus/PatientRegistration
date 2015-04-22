<?php
$host = "127.0.0.1:4655";
$user = "root";
$pass = "grad2015";
$dtbs = "AllTeam";

$link = mysql_connect($host, $user, $pass);
if (!$link){die('Could not connect: ' . mysql_error());}
mysql_select_db($dtbs);
if ($argc !== 3) {
	exit("usage is php FacilityAppointments.php '<facility name>' '<yyyy-dd-mm>'\n");
}

/* Parse the args
*/
$arg1 = $argv[1];
$arg2 = $argv[2];

// Display a list of the appointments at a facility on a specific day /report
echo "Appointments for ".$arg1." on ".$arg2."\n";
echo "Patient Name\t|\tPatient Phone\t|\tDoctor Name\t|\tNurse Name\n";
echo "----------------------------------------------------------------\n";
$sql = "select a.NurseId as NId, a.DoctorId as DId, a.PersonId as PId  from Appointment a 
		where a.OrganizationId = (select OrganizationId from Organization where OrganizationName = '{$arg1}')
		and a.AppointmentDateTime like '{$arg2}%'";
		
$result = mysql_query($sql) or die('php failure - Unable to execute query! '.$sql);

while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	$sqlP = "select FirstName, LastName, PhoneNo from Person where PersonId = '{$row['PId']}'";
	$result = mysql_query($sqlP) or die('php failure - Unable to execute query! '.$sql);
	$rowP = mysql_fetch_array($result, MYSQL_ASSOC);

	$sqlD = "select FirstName, LastName from Person where PersonId = '{$row['DId']}'";
	$result = mysql_query($sqlD) or die('php failure - Unable to execute query! '.$sql);
	$rowD = mysql_fetch_array($result, MYSQL_ASSOC);
	$sqlN = "select FirstName, LastName from Person where PersonId = '{$row['NId']}'";
	$result = mysql_query($sqlN) or die('php failure - Unable to execute query! '.$sql);
	$rowN = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo $rowP['FirstName']." ".$rowP['LastName']."\t|\t".$rowP['PhoneNo']."\t|\tDr.".$rowD['LastName']."\t|\t".$rowN['FirstName']." ".$rowN['LastName']."\n";
}
mysql_free_result($result);


?>