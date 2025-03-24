<?php

namespace App\Models;
require_once "../vendor/autoload.php";

class Auth
{

    public static function attempt(string $email, string $password)
    {

        $user = User::findByEmail($email);
        if (!$user) 
        {
            return false;
        }

        if (!password_verify($password, $user->getPassword())) 
        {
            return false;
        }

        if ($user->getStatus() == "inactive") 
        {
            return "unactive";
        }

        session_start();

        $s = new Session();

        $s->setUser_id($user->getId());
        $s->setLogin_time(date("Y-m-d H:i:s"));

        $id = $s->save();


        $_SESSION['session_id'] = $id;
        $_SESSION['user_id'] = $user->getId();

        return true;
    }

    public static function user()
    {

        if (session_status() !== PHP_SESSION_ACTIVE) 
        {
            return false;  
        }
        if(isset($_SESSION['user_id']))
        {
            return User::find($_SESSION['user_id']);
        }
    }

    public static function logout()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
            $id = $_SESSION['session_id'];

            $s = Session::find($id);

            $s->complete(date("Y-m-d H:i:s"));
        }
        
        session_destroy();
    }
}