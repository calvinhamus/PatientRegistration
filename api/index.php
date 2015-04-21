<?php
require 'vendor/autoload.php';
require 'config.php';

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
    try {
        $dao = new \Prams\Dao();
        $req = $app->request();
        $facilityId = $req->get('facilityId');

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
    try {
        $dao = new \Prams\Dao();
        $req = $app->request();
        $primCareDrId = $req->get('primCareDrId');

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

$app->run();
