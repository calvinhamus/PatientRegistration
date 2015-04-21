# Patient Registration and Monitoring System

## API Reference

The API contains the following endpoints.

### GET /api/doctors

**Query string params**

* facilityId (optional)

Gets all doctors or just doctors at the given facility.

### GET /api/doctors/:id

Gets the doctor with the given id.

### GET /api/facilities

Gets all facilities.

### GET /api/facilities/:id

Gets the facility with the given id.

### GET /api/nurses

Gets all nurses.

### GET /api/nurses/:id

Gets the nurse with the given id.

### GET /api/patients

**Query string params**

* primCareDrId (optional)

Gets all patients or just patients with a particular primary care doctor.

### GET /api/patients/:id

Gets the patient with the given id.

### POST /api/nurses/assign

**Post params**

* nurseId (required)
* doctorId (required)
* facilityId (required)

Assigns a nurse to support a doctor at a facility.

### POST /api/appointment

**Post params**

* dateTime (required)
* patientId (required)
* nurseId (required)
* doctorId (required)
* facilityId (required)

Creates a new appointment.