<?php

/**
 * home short summary.
 *
 * home description.
 *
 * @version 1.0
 * @author Jelena
 */
class HomeController extends Controller
{
    public function index()
    {
        
        $this->View->render('pages/index');
        exit();
    }

    public function events()
    {
        
        $this->View->render('pages/events');
        exit();
    }

    public function preformances()
    {
        
        $this->View->render('pages/preformances');
        exit();
    }

    public function artists()
    {
        
        $this->View->render('pages/artists');
        exit();
    }

    public function contact()
    {
        
        $this->View->render('pages/contact');
        exit();
    }


}