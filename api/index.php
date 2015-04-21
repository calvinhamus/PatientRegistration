<?php
require 'vendor/autoload.php';
require 'config.php';

$app = new \Slim\Slim();
$app->response()->headers->set('Content-Type', 'application/json');

/**
 * Gets all doctors or just doctors at the given facility.
 *
 * Usage: GET /doctors
 *        GET /doctors?facilityId=1
 */
$app->get('/doctors', function() use ($app) {
    try {
        $dao = new \Prams\Dao();
        $req = $app->request();
        $facilityId = $req->get('facilityId');
        if ($facilityId) {
            $doctors = $dao->getDoctorsByFacilityId($facilityId);
        } else {
            $doctors = $dao->getAllDoctors();
        }

        if ($doctors) {
            $code = 200;
            $message = '';
            $data = array('doctors' => $doctors);
        } else {
            $code = 404;
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
 * Gets all facilities.
 *
 * Usage: GET /facilities
 */
$app->get('/facilities', function() use ($app) {
    try {
        $dao = new \Prams\Dao();
        $facilities = $dao->getAllFacilities();
        if ($facilities) {
            $code = 200;
            $message = '';
            $data = array('facilities' => $facilities);
        } else {
            $code = 404;
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
 * Gets all nurses.
 *
 * Usage: GET /nurses
 */
$app->get('/nurses', function() use ($app) {
    try {
        $dao = new \Prams\Dao();
        $nurses = $dao->getAllNurses();
        if ($nurses) {
            $code = 200;
            $message = '';
            $data = array('nurses' => $nurses);
        } else {
            $code = 404;
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
 * Gets all patients or just patients with a particular primary care doctor.
 *
 * Usage: GET /patients
 *        GET /patients?primCareDrId=1
 */
$app->get('/patients', function() use ($app) {
    try {
        $dao = new \Prams\Dao();
        $req = $app->request();
        $primCareDrId = $req->get('primCareDrId');
        if ($primCareDrId) {
            $patients = $dao->getPatientsByPrimaryCareDoctor($primCareDrId);
        } else {
            $patients = $dao->getAllPatients();
        }

        if ($patients) {
            $code = 200;
            $message = '';
            $data = array('patients' => $patients);
        } else {
            $code = 404;
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
