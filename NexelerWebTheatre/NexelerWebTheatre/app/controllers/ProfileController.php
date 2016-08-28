<?php

/**
 * ProfileController short summary.
 *
 * ProfileController description.
 *
 * @version 1.0
 * @author Jelena
 */
class ProfileController extends Controller
{

    public function profilepage()
    {
        $userid = Session::get('user_id');
        if($userid){
            $user = User::getUserById($userid);
            $this->View->render('usermanagement/profile',array('user' => $user));
            exit();
        }
       
    }

    public function editprofile()
    {
        $userid = Session::get('user_id');
        if($userid){
            $user = User::getUserById($userid);
            $this->View->render('usermanagement/profile_edit',array('user' => $user));
            exit();
        } 
    }

    public function edituser()
    {
        $user_id = strip_tags(Request::post('userID'));
        $name = strip_tags(Request::post('name'));
        $last_name = strip_tags(Request::post('last_name'));
        $user_name = strip_tags(Request::post('user_name'));
        $email = strip_tags(Request::post('email'));
        $password = Request::post('password');
        $password_repeat = Request::post('password_repeat');

        $result = UserManager::updateUserData( $user_id,$name,$last_name,$user_name,$email,$password,$password_repeat);
        
        if($result){
            Redirect::to('profile/profilepage');
            exit();
        }else{
            Redirect::to('profile/editprofile');
            exit();
        }
        
    }
}