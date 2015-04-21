# Patient Registration and Monitoring System

## API Reference

The API contains the following endpoints.

### GET /api/doctors

**Query string params**

* facilityId (optional)

Gets all doctors or just doctors at the given facility.

### GET /api/facilities

Gets all facilities.

### GET /api/nurses

Gets all nurses.

### GET /api/patients

**Query string params**

* primCareDrId (optional)

Gets all patients or just patients with a particular primary care doctor.
