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
    protected $controller = 'home';
    protected $medhod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
    }

    protected function parseUrl()
    {
        if(isset($_GET['url']))
        {
            return $url = explode('/',filter(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
        }


    }
}
?>