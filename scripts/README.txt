Readme for the load nurse tables scripts. 

Files:
Load-Nurse-AllTeam.sql
nurse.unl
NursePerson.unl

Description:
This sql will disable all constraints on the nurse and person tables, it will load 30 persons then it will load the PersonIds from the 30 persons and their nurse license number into the nurse table. Finally it will reanable the constraints. 

Usage:
Keep all 3 files in the same directory or within the Load-Nurse-AllTeam.sql set the path to the nurse.unl and NursePerson.unl so that the sql can find it. 
Remember you may need to escape a backslash with another backslash in the path if you are in a windows environment. 

****************************************************************************************************************************************************************************************************************************************************


 
Readme for PHP Report scripts

Files:
FacilityAppointments.php
DoctorAppointments.php


Description:
DoctorAppointments.php will display the Doctor, facility and date passed in and the list of patients first and last names derived from those args in the following format

Patients for Dr Bob at St Lukes on 2014-04-19 
-----------------------------------------------
Dustin Seybold
John Smith
Marry Sue

FacilityAppointments.php ill display the Facility and Date passed in as args and the Patient First Name, Middle Name, Last name and phone number, Doctor Name, and Nurse Name 
derived from that information in the following format


Patient Name	|	Patient Phone	|	Doctor Name	|	Nurse Name
-------------------------------------------------------------------
Dustin Seybold	|	208-371-2138	|	Dr. Cron	|	Betty Jones 
John Smith	|	208-999-3333	|	Dr Doe		|	Mary Ann




Usage:  
php DoctorAppointments.php '<DoctorsLastName>' '<facility name>' '<yyyy-dd-mm>'

php FacilityAppointments.php '<facility name>' '<yyyy-dd-mm>'


**WARNING**
Please note that the ' around each parameter is only needed if there is a space in the parameter and that is a bash issue not a php issue. 