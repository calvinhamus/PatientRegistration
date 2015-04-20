<?php
namespace Prams;

class Util {
    /**
     * Builds a JSON response for a REST API.
     *
     * @param $code
     * @param $message
     * @param array $data
     * @return string The JSON response
     */
    public static function buildJsonResponse($code, $message, $data = array()) {
        return json_encode(array('responseCode' => $code, 'message' => $message, 'data' => $data));
    }
}