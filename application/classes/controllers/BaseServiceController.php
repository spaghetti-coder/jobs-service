<?php

abstract class BaseServiceController {
    public function __construct() {
        header('Content-type: application/json; charset=utf-8');
    }
}
