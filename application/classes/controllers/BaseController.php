<?php

abstract class BaseController {
    public function __construct() {
        
    }
    
    /**
     * Try to print passed object as json and exit script execution
     * or throw HttpError if the passed object is false
     * 
     * @param  mixed $object Object or array to be printed as json
     * @param  string $errorMessage Error message for HttpError
     * @throws HttpError 
     */
    public function printJsonOrFail($object, $errorMessage = '') {
        // If the object is false, throe 400 error
        if ($object === false) {
            throw new HttpError($errorMessage, 400);
        }
        
        header('Content-type: application/json; charset=utf-8');
        exit(json_encode($object));
    }
}
