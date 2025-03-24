<?php
//require_once "../vendor/autoload.php";
require_once "../src/Controllers/UserController.php";

use App\Controllers\AuthController;
use App\Controllers\UserContoller;

$control = new UserContoller();
$authControl = new AuthController();


$uri = parse_url($_SERVER["REQUEST_URI"])["path"];


//Authenfification routes

if($uri === "/" && $_SERVER["REQUEST_METHOD"] == "GET")
{
    $authControl ->loginForm();
}

else if($uri === "/login" && $_SERVER["REQUEST_METHOD"] == "GET")
{
    $authControl ->loginForm();
}

elseif($uri === "/login" && $_SERVER["REQUEST_METHOD"] == "POST")
{
    $authControl->login();
}

elseif($uri === "/admin" && $_SERVER["REQUEST_METHOD"] == "GET")
{
    $control->displayAdmin();
}

elseif($uri === "/logout")
{
    $authControl->logout();
}

//User Profile routes
elseif($uri === "/profile" && $_SERVER["REQUEST_METHOD"] == "GET")
{   
    $control->displayProfile();
}

elseif($uri === "/update" && $_SERVER["REQUEST_METHOD"] == "POST")
{   
    $control->update();
}

elseif($uri === "/update-password" && $_SERVER["REQUEST_METHOD"] == "POST")
{   
    $control->updatePassword();
}

//Administrative routes

elseif($uri === "/create" && $_SERVER["REQUEST_METHOD"] == "POST")
{   
    $control->create();
}

//Let's try using api

elseif($uri === "/admin/update" && $_SERVER["REQUEST_METHOD"] == "POST")
{   
    $control->adminUpdate();
}

elseif($uri === "/admin/userdata" && $_SERVER["REQUEST_METHOD"] == "POST")
{   
    $control->getUserData();
}

elseif($uri === "/details" && $_SERVER["REQUEST_METHOD"] == "GET")
{   
    $query = parse_url($_SERVER["REQUEST_URI"])["query"];
    $control->userDetails($query);
}

elseif($uri === "/delete" && $_SERVER["REQUEST_METHOD"] == "POST")
{   
    $control->delete();
}

else
{
    $control->notFound();
}

