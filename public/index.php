<?php // Entry point

// Application directory path
$appDir = './../application';

/**
 * Application directory absolute path
 */
define('APPDIR', realpath($appDir));


unset($appDir);