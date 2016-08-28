<?php

/**
 * Controller short summary.
 *
 * Controller description.
 *
 * @version 1.0
 * @author Jelena
 */
class Controller
{

    public $View;

    public function __construct()
    {
       
        require_once  '/../config/constants.php';

        // always initialize a session
        Session::init();

        // create a view object to be able to use it inside a controller, like $this->View->render();
        $this->View = new View();
    }
}

