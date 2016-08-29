<?php

class LoginController extends Controller
{
    public function loginpage()
    {
        //UserManager::login(Request::post('user_name',true),Request::post('password',true));
        $this->View->render('usermanagement/login');
        exit();
    }

   

    public function login()
    {
        $result = UserManager::login(Request::post('user_name',true),Request::post('password',true));
        
        if($result){
            //$this->View->render('usermanagement/login');
            //exit();
            Redirect::home();
            exit();
        }else{
            Redirect::to('login/loginpage');
            exit();
        }
        
    }


    public function logout()
    {
        //// This is in the PHP file and sends a Javascript alert to the client
        //$message = "wrong answer";
        //echo "<script type='text/javascript'>alert('$message');</script>";
        UserManager::logout();
        Redirect::home();
    }


}
?>
