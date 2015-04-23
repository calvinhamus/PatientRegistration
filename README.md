# Patient Registration and Monitoring System

## About

This is a grad student team project for CompSci 510 (Databases) at Boise State. The project consists of discrete pieces of a larger application built by several teams.

## Team

* Calvin Hamus
* Dustin Seybold
* Patrick Lee

## How to Use

The load scripts and report generators have their own README file and are located in the scripts folder of this project.

The Web application consists of a front end built using Twitter Bootstrap and a REST API built with the Slim Framework in PHP. The app is available for review internally in the CS department at the following URL...

    http://web/~plee/PatientRegistration/

The Web app consists of the following pages...

* **Dashboard:** Just a placeholder to provide navigation to the other two pages.
* **Assign Nurse:** Contains a form that can be used to assign a nurse to all of a doctor's future appointments at a particular facility.
* **Appointment Details:** Contains a form for scheduling a future appointment including the patient, nurse, and doctor. The facility is determined automatically based on the doctor's availability and scheduling is only possible in open time slots.