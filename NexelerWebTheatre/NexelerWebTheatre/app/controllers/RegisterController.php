<?php

/**
 * RegistrerController short summary.
 *
 * RegistrerController description.
 *
 * @version 1.0
 * @author Jelena
 */
class RegisterController extends Controller
{
    public function registerpage()
    {
      
        $this->View->render('usermanagement/register');
        exit();
    }


    public function register()
    {
        //$message = "correct answer";
        //echo "<script type='text/javascript'>alert('$message');</script>";

        $name = strip_tags(Request::post('name'));
        $last_name = strip_tags(Request::post('last_name'));
        $user_name = strip_tags(Request::post('user_name'));
        $email = strip_tags(Request::post('email'));
        $password = Request::post('password');
        $password_repeat = Request::post('password_repeat');

        $result = UserManager::registerNewUser( $name,$last_name,$user_name,$email,$password,$password_repeat);
        
        if($result){
            Redirect::to('login/loginpage');
            exit();
        }else{
            Redirect::to('register/registerpage');
            exit();
        }
    }

    public function checkUsername(){

        $user_name = strip_tags(Request::post('username'));
        $result =  UserManager::checkUsernameAvailability($user_name);

        if($result){
            echo "NOT AVAILABLE";
        }
        else{
            echo "AVAILABLE";
        }
    }


}