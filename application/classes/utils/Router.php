<?php

/**
 * Router class
 * It manages routes and keeps information about current
 * running route
 */
class Router {
    private $routesPath;
    private $url;
    
    /**
     * @param string $url Current url
     * @param string $routesPath Path to routes file in
     *      the application directory without path to application directory
     *      and file extension (it's .php by default)
     */
    public function __construct($url, $routesPath) {
        $this->url = $url;
        $this->routesPath = $routesPath;
    }
    
    /**
     * Get map for the current URL or false in case current URL
     * doesn't match any of url patterns. The map is in the
     * followin format:
     * <pre>
     * array(
     *   'controller' => {controllerName},
     *   'action'     => {actionName},
     *   'params'     => {paramsARray}
     * )
     * </pre>
     * @return mixed
     */
    public function getMap() {
        // Get all application routes
        $routes = $this->getAppRoutes();
        
        // Iterate over routes comparing current url with
        // url patterns and return map for the matching one (if any)
        foreach ($routes as $urlPattern => $map) {
            if (preg_match($urlPattern, $this->url, $matches)) {
                $ret = $this->convertStringMapToArray($map);
                $ret['params'] = array_slice($matches, 1);
                
                return $ret;
            }
        }
        
        return false;
    }
    
    /**
     * Transforms string map to array map of this type:
     * <pre>
     * array(
     *   'controller' => {controllerName},
     *   'action'     => {actionName}
     * )
     * </pre>
     * @param string $map String map representation
     * @return array
     * @throws Exception If the map is in invalid format
     */
    private function convertStringMapToArray($map) {
        // Split controller and action into two positions in array
        $controllerAndAction = explode('@', $map, 2);
        if (count($controllerAndAction) < 2) {
            throw new Exception('Map ' . $map . ' is invalid.');
        }
        
        list($controller, $action) = $controllerAndAction;
        
        return array(
            'controller' => $controller,
            'action'     => $action,
        );
    }
    
    /**
     * Get application routes
     * 
     * @return array
     */
    private function getAppRoutes() {
        return require APPDIR . '/' . $this->routesPath . '.php';
    }
}
