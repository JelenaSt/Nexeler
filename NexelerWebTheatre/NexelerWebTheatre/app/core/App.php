<?php

/**
 * App short summary.
 *
 * App description.
 *
 * @version 1.0
 * @author Jelena
 */
class App
{
    protected $controller;
    protected $method;
    protected $params = [];

    public function __construct()
    {
        
        $this->parseUrl();

        // creates controller and action names (from URL input)
        $this->createControllerAndActionNames();

        if(file_exists(Config::get('PATH_CONTROLLER') . $this->controller . '.php'))
        {
            require_once Config::get('PATH_CONTROLLER') . $this->controller . '.php';
            $this->controller = new $this->controller;

            if (method_exists($this->controller, $this->method)) 
            {
                if (!empty($this->parameters)) 
                {
                    // call the method and pass arguments to it
                   
                    call_user_func_array(array($this->controller, $this->method), $this->parameters);
                } else 
                {
                    // if no parameters are given, just call the method without parameters, like $this->index->index();
                    $this->controller->{$this->method}();
                }
            }
        }
       
    }

    protected function parseUrl()
    {
        if(isset($_GET['url']))
        {
            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->controller = isset($url[0]) ? $url[0] : null;
            $this->method = isset($url[1]) ? $url[1] : null;
            // remove controller name and action name from the split URL
            unset($url[0], $url[1]);
            // rebase array keys and store the URL parameters
            $this->params = $url ? array_values($url) : [];
        }
      
    }

    private function createControllerAndActionNames()
    {
        // check for controller: no controller given ? then make controller = default controller (from config)
        if (!$this->controller) {
            $this->controller = Config::get('DEFAULT_CONTROLLER');
        }
        // check for action: no action given ? then make action = default action (from config)
        if (!$this->method OR (strlen($this->method) == 0)) {
            $this->method = Config::get('DEFAULT_ACTION');
        }
        // rename controller name to real controller class/file name ("index" to "IndexController")
        $this->controller = ucwords($this->controller) . 'Controller';
       
    }
}

