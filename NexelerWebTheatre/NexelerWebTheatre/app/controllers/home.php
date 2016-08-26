<?php

/**
 * home short summary.
 *
 * home description.
 *
 * @version 1.0
 * @author Jelena
 */
class Home extends Controller
{
    public function index()
    {
        header("Location: http://localhost/nexeler/app/views/home/homePage.php");
        exit();
    }


}