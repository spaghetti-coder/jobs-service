<?php // Startup configuration

// Set internal character encoding to utf-8
mb_internal_encoding('UTF-8');

// Register class autoloader,
// http://php.net/manual/en/function.spl-autoload-register.php for more info
spl_autoload_register(function ($class) {
    $autoloads = require APPDIR . '/autoloads.php';
    
    // Iterate over autloads directories and include
    // if appropriate class is found in one of them
    foreach ($autoloads as $dir) {
        $filePath = $dir . '/' . $class . '.php';
        if (is_file($filePath)) {
            require_once $filePath;
        }
    }
});

// Run request
$url = filter_input(INPUT_GET, 'id') || '';
try {
    Request::getInstance($url)->run();
} catch (HttpError $ex) {
    header($_SERVER['SERVER_PROTOCOL'] . ' ' . $ex->getCode() . ' ' . $ex->getMessage());
}