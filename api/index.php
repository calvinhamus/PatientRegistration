<?php
require 'vendor/autoload.php';
require 'config.php';

date_default_timezone_set('America/Boise');

$app = new \Slim\Slim();
$app->response()->headers->set('Content-Type', 'application/json');

/**
 * Gets all doctors, one doctor (if id provided), or just doctors at the given facility.
 *
 * Usage: GET /doctors
 *        GET /doctors/1
 *        GET /doctors?facilityId=1
 */
$app->get('/doctors(/:id)', function($id = 0) use ($app) {
    $facilityId = $app->request->get('facilityId');

    try {
        $dao = new \Prams\Dao();

        if ($id > 0) {
            $doctors = $dao->getDoctorById($id);
        } else if ($facilityId) {
            $doctors = $dao->getDoctorsByFacilityId($facilityId);
        } else {
            $doctors = $dao->getAllDoctors();
        }

        if ($doctors) {
            $code = 200;
            $message = '';
            $data = array('doctors' => $doctors);
        } else {
            $code = 222;
            $message = 'No doctors found.';
            $data = array();
        }
    } catch (PDOException $e) {
        $code = 500;
        $message = $e->getMessage();
        $data = array();
    }

    $app->response()->setStatus($code);
    $app->response()->setBody(\Prams\Util::buildJsonResponse($code, $message, $data));
});

/**
 * Gets all facilities or one facility (if id provided).
 *
 * Usage: GET /facilities
 *        GET /facilities/1
 */
$app->get('/facilities(/:id)', function($id = 0) use ($app) {
    try {
        $dao = new \Prams\Dao();

        if ($id > 0) {
            $facilities = $dao->getFacilityById($id);
        } else {
            $facilities = $dao->getAllFacilities();
        }

        if ($facilities) {
            $code = 200;
            $message = '';
            $data = array('facilities' => $facilities);
        } else {
            $code = 222;
            $message = 'No facilities found.';
            $data = array();
        }
    } catch (PDOException $e) {
        $code = 500;
        $message = $e->getMessage();
        $data = array();
    }

    $app->response()->setStatus($code);
    $app->response()->setBody(\Prams\Util::buildJsonResponse($code, $message, $data));
});

/**
 * Gets all nurses or one nurse (if id provided).
 *
 * Usage: GET /nurses
 *        GET /nurses/1
 */
$app->get('/nurses(/:id)', function($id = 0) use ($app) {
    try {
        $dao = new \Prams\Dao();

        if ($id > 0) {
            $nurses = $dao->getNurseById($id);
        } else {
            $nurses = $dao->getAllNurses();
        }

        if ($nurses) {
            $code = 200;
            $message = '';
            $data = array('nurses' => $nurses);
        } else {
            $code = 222;
            $message = 'No nurses found.';
            $data = array();
        }
    } catch (PDOException $e) {
        $code = 500;
        $message = $e->getMessage();
        $data = array();
    }

    $app->response()->setStatus($code);
    $app->response()->setBody(\Prams\Util::buildJsonResponse($code, $message, $data));
});

/**
 * Gets all patients, one patient (if id provided), or just patients with a particular primary care doctor.
 *
 * Usage: GET /patients
 *        GET /patients/1
 *        GET /patients?primCareDrId=1
 */
$app->get('/patients(/:id)', function($id = 0) use ($app) {
    $primCareDrId = $app->request->get('primCareDrId');

    try {
        $dao = new \Prams\Dao();

        if ($id > 0) {
            $patients = $dao->getPatientById($id);
        } else if ($primCareDrId) {
            $patients = $dao->getPatientsByPrimaryCareDoctor($primCareDrId);
        } else {
            $patients = $dao->getAllPatients();
        }

        if ($patients) {
            $code = 200;
            $message = '';
            $data = array('patients' => $patients);
        } else {
            $code = 222;
            $message = 'No patients found.';
            $data = array();
        }
    } catch (PDOException $e) {
        $code = 500;
        $message = $e->getMessage();
        $data = array();
    }

    $app->response()->setStatus($code);
    $app->response()->setBody(\Prams\Util::buildJsonResponse($code, $message, $data));
});

/**
 * Assigns a nurse to support a doctor at a facility.
 *
 * Usage: POST /nurses/assign (params = nurseId, doctorId, facilityId)
 */
$app->post('/nurses/assign', function() use ($app) {
    $nurseId = $app->request->post('nurseId');
    $doctorId = $app->request->post('doctorId');
    $facilityId = $app->request->post('facilityId');

    try {
        $dao = new \Prams\Dao();
        $dao->assignNurseToDoctorAtFacility($nurseId, $doctorId, $facilityId);
        $code = 200;
        $message = '';
        $data = array(); # TODO: return list of assigned appointments?
    } catch (PDOException $e) {
        $code = 500;
        $message = $e->getMessage();
        $data = array();
    }

    $app->response()->setStatus($code);
    $app->response()->setBody(\Prams\Util::buildJsonResponse($code, $message, $data));
});

/**
 * Creates a new appointment.
 *
 * Usage: POST /appointment (params = dateTime, patientId, doctorId)
 */
$app->post('/appointment', function() use ($app) {
    $dateTime = $app->request->post('dateTime');
    $patientId = $app->request->post('patientId');
    $doctorId = $app->request->post('doctorId');

    try {
        $dao = new \Prams\Dao();
        $availability = $dao->checkDoctorAvailability($dateTime, $doctorId);
        if (!$availability) {
            $code = 224;
            $message = 'Doctor is not available at that date and time.';
            $data = array();
        } else {
            $facilityId = $availability[0]->OrganizationId;
            $dao->createAppointment($dateTime, $patientId, $doctorId, $facilityId);
            $code = 200;
            $message = '';
            $data = array(); # TODO: return newly created appointment?
        }
    } catch (PDOException $e) {
        $code = 500;
        $message = $e->getMessage();
        $data = array();
    }

    $app->response()->setStatus($code);
    $app->response()->setBody(\Prams\Util::buildJsonResponse($code, $message, $data));
});

$app->run();
