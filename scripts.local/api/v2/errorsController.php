<?php
$http_errors = array(
    '400' => 'Bad Request',
    '401' => 'Unauthorized',
    '403' => 'Forbidden',
    '404' => 'Not Found',
    '405' => 'Method Not Allowed',
    '406' => 'Not Acceptable',
    '500' => 'Internal Server Error'
    );

/**
 * This method returns error with text message to the front
 * @param $code int of the error
 */
function outputError($code){
    http_response_code($code);
    $text = '';
    switch ($code){
        case 400: $text = 'Bad Request'; break;
        case 401: $text = 'Unauthorized'; break;
        case 403: $text = 'Forbidden'; break;
        case 404: $text = 'Not Found'; break;
        case 405: $text = 'Method Not Allowed'; break;
        case 406: $text = 'Not Acceptable'; break;
        case 500: $text = 'Internal Server Error'; break;
    }
    echo json_encode(array('error' => $text));
}
