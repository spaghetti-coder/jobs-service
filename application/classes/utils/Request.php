<?php

/**
 * Application request class
 * It's responsible for processing the current request
 */
class Request {
    /**
     * @var Request
     */
    private static $instance;
    /**
     * Current URL
     * @var string
     */
    private $url;
    /**
     * Router instance
     * @var Router
     */
    private $router;
    
    /**
     * Singleton get instance method
     * 
     * @param string $url Current url
     * @return Request
     */
    public static function getInstance($url) {
        /**
         * Create instance if it has not been created yet
         */
        if (! self::$instance) {
            self::$instance = new self($url);
        }
        
        return self::$instance;
    }
    
    private function __construct($url) {
        $this->url = $url;
        $this->router = new Router($url, 'routes');
    }
    
    /**
     * Run request
     * 
     * @throws Error404
     */
    public function run() {
        $map = $this->router->getMap();
        if (! $map) {
            throw new HttpError('Not Found', 404);
        }
        
        // Create reflection objects for controller and action
        $reflectionController = $this->getReflectionController($map['controller']);
        $reflectionMethod = $this->getReflectionAction($map['action'], $reflectionController);
        
        // Throw Error404 if action arity doesn't coinside
        // with number of params passed
        if ($reflectionMethod->getNumberOfRequiredParameters() < count($map['params'])) {
            throw new HttpError('Not Found', 404);
        }
        
        // Create controller and invoke action
        // reflection object on it
        $controllerObject = $reflectionController->newInstance();
        $reflectionMethod->invokeArgs($controllerObject, $map['params']);
    }
    
    /**
     * Create controller class reflection object
     *
     * @param type $controller
     * @return \ReflectionClass
     * @throws Error404
     */
    private function getReflectionController($controller) {
        $controllerName = $controller . 'Controller';
        $filePath = APPDIR . '/classes/controllers/' . $controllerName . '.php';
        
        // Throw Error404 if controller file doesn't exist
        if (! is_file($filePath)) {
            throw new HttpError('Not Found', 404);
        }
        
        require_once $filePath;
        
        // Throw Error404 if controller class doesn't exist
        if (! class_exists($controllerName, false)) {
            throw new HttpError('Not Found', 404);
        }
        
        return new ReflectionClass($controllerName);
    }
    
    /**
     * Create action method reflection object
     * 
     * @param type $action
     * @param ReflectionClass $reflectionController
     * @return \ReflectionMethod
     * @throws Error404
     */
    private function getReflectionAction($action, $reflectionController) {
        $actionName = 'action_' . $action;
        
        // Throw Error404 if controller class doesn't exist
        if (! $reflectionController->hasMethod($actionName)) {
            throw new HttpError('Not Found', 404);
        }
        
        return $reflectionController->getMethod($actionName);
    }
}
