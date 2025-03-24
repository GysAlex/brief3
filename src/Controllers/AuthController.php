<?php
namespace App\Controllers;
require_once "../vendor/autoload.php";

use App\Models\Auth;
use App\Models\User;


class AuthController 
{
    private $viewPath = "../src/Views";
    private $userMail;
    private $attempts = 0;

    public function loginForm()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }

        if (Auth::user()) 
        {
            http_response_code(301);
            header('location: /profile?logout=false');
        }
        
        require_once "$this->viewPath/Login.php";
        exit();
    }

    public function login()
    {
        if(!isset($_POST))
        {
            header("location: /login");
            exit();
        }

        else if(empty($_POST['email']) || empty($_POST['password']))
        {
            header("location: /login?fail=form");
            exit();
        }

        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);


        $user = Auth::attempt($email, $password);

        if (!$user) 
        {
            setcookie('user_email', $email, time() + 30, "/login", "", false, true);
            header("location: /login?fail=login");
            exit();
        }

        if($user == "unactive")
        {
            setcookie('user_email', $email, time() + 30, "/login", "", false, true);
            header("location: /login?fail=unactive");
            exit();
        }

        $user = User::find($_SESSION['user_id']);
        header("location: /profile?success=1");
    }

    public function logout()
    {
        Auth::logout();
        header("location: /login");
    }
}