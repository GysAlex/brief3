<?php
namespace App\Controllers;

use App\Models\Auth;
use App\Models\Role;
use App\Models\User;
use Utils\Storage\Storage;

require_once "../vendor/autoload.php";


class UserContoller
{
    private $viewPath = "../src/Views";

    public function displayProfile()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }

        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        if(Auth::user() == "unactive")
        {
            setcookie('user_email', Auth::user()->getEmail(), time() + 30, "/login", "", false, true);
            header("location: /login?fail=unactive");
            exit();
        }

        $username = Auth::user()->getUsername();
        $email = Auth::user()->getEmail();
        $status = Auth::user()->getStatus();
        $role_id = Auth::user()->getRole_id();
        $image = Auth::user()->getImage();

        if($image)
            $image = Storage::getUrl($image);


        $role = Role::find((int)$role_id);


        $role_name = $role->getName();

        $sessions = Auth::user()->sessions();

        require_once "$this->viewPath/Profile.php";
    }

    public function displayAdmin()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
        
        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        if(Auth::user() == "unactive")
        {
            setcookie('user_email', Auth::user()->getEmail(), time() + 30, "/login", "", false, true);
            header("location: /login?fail=unactive");
            exit();
        }

        if (Auth::user()->getRole_id() != 1) 
        {
            header("location: /profile?forbi=1");
            exit();
        }

        $username = Auth::user()->getUsername();
        $email = Auth::user()->getEmail();
        $status = Auth::user()->getStatus();


        $image = Auth::user()->getImage();
        if($image)
            $image = Storage::getUrl($image);
        
        $role_id = Auth::user()->getRole_id();


        $role = Role::find($role_id);

        $role_name = $role->getName();


        $users = User::all();
        $roles = Role::all();

        require_once "$this->viewPath/Admin.php";
    }

    public function update()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
        
        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        $data = $this->getCheckData("prolile");

        $user = Auth::user();

        if ($user->getImage()) 
        {
            unlink("assets/".Storage::getUrl(Auth::user()->getImage()));
        }

        $user->clientUpdate($data);

        header('location: /profile?update=success');
                
    }

    public function create()
    {
        $data = $this->getCheckData("admin");
        if (empty($data['role_id']) || empty($data['status'])) 
        {
            header('location: /admin?fail=form');
            exit();
        }

        User::create($data);
        header('location: /admin?success=1');
    }

    private function getCheckData(string $redirectUri)
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
        
        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        if(isset($_POST))
        {

            if(empty($_POST['username']) || empty($_POST['email']))
            {
                header("location: /$redirectUri?fail=form");
            } 

            else
            {
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']) ?? '';
                $role_id = htmlspecialchars($_POST['role_id'] ?? '');
                $status = htmlspecialchars($_POST['status'] ?? '');

                if (isset($_FILES)) 
                {
                    $image_file = $_FILES["image"];
    
                    if (isset($image_file) && !empty($image_file['name'])) 
                    {
                        // Exit if image file is zero bytes
                        if (filesize($image_file["tmp_name"]) <= 0) {
                            header("location: /$redirectUri?fail=image");
                            exit();
                        }
        
                        $image_type = exif_imagetype($image_file["tmp_name"]);
        
                        if (!$image_type) {
                            header("location: /$redirectUri?fail=image");
                            exit();
                        }
        
                        $image = Storage::store($image_file);
                
                        return [
                            "username" => $username,
                            "email" => $email,
                            "password" => $password,
                            "role_id" => $role_id,
                            "status" => $status,
                            "image" => $image
                        ];
                    }
        

                }
                              
                return [
                    "username" => $username,
                    "email" => $email,
                    "password" => $password,
                    "role_id" => $role_id,
                    "status" => $status,
                ];
            }
        }

        else 
        {
            header('location: /profile?fail=form');
            exit();
        }
    }

    public function adminUpdate()
    {
        $data = $this->getCheckData("admin");
        

        if (empty($data['role_id']) || empty($data['status']) || empty($_POST['id'])) 
        {
            header('location: /admin?fail=form');
            exit();
        }

        $user = User::find(htmlspecialchars($_POST['id']));
        
        if($user->getImage()) 
        {
            if($data['image'])
            {
                unlink("assets/".Storage::getUrl($user->getImage()));
            }
        }


        if($user)
        {
            $user->update($data);
            header('location: /admin?success=2');
        }
        else
        {
            header('location: /admin?fail=form');
            exit();
        }
    }

    public function getUserData()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
        
        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        if(Auth::user() == "unactive")
        {
            setcookie('user_email', Auth::user()->getEmail(), time() + 30, "/login", "", false, true);
            header("location: /login?fail=unactive");
            exit();
        }

        if (Auth::user()->getRole_id() != 1) 
        {
            header("location: /profile?forbi=1");
            exit();
        }

        if($_SERVER['REQUEST_METHOD']=== 'POST')
        {
            if(isset($_POST))
            {
                $id = htmlspecialchars($_POST['id']);
                $user = User::find($id);


                echo json_encode([
                    "username" => $user->getUsername(),
                    "email" => $user->getEmail(),
                    "password" => "",
                    "role_id" => $user->getRole_id(),
                    "status" => $user->getStatus(),
                    "id" => $user->getId()
                ]);
            }
            
        }
    }

    public function updatePassword()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
        
        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        if(Auth::user() == "unactive")
        {
            setcookie('user_email', Auth::user()->getEmail(), time() + 30, "/login", "", false, true);
            header("location: /login?fail=unactive");
            exit();
        }

        if(isset($_POST))
        {
            $old = htmlspecialchars($_POST['old_password']);
            $new = htmlspecialchars($_POST['new_password']);

            if(password_verify($old, Auth::user()->getPassword()))
            {
                $user = Auth::user();

                $user->updatePassword($new);

                $_SESSION['success_password_update'] = 'Votre mot de passe a bien été modifier';
                header('location: /profile?success=1');
            }

            else
            {
                header('location: /profile?fail=1');
            }
        }
    }

    public function userSessions()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
        
        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        if($_SERVER['REQUEST_METHOD']=== 'POST')
        {
            if(isset($_POST))
            {
                print_r($_POST);

                //$id = htmlspecialchars($_POST['id']);
                $user = User::find(2);


                $sessions = $user->sessions();

                $sessionsArray = [];

                foreach($sessions as $session)
                {
                    $sessionsArray[] = (array)$session;
                }

                header('Content-Type: application/json');
                echo json_encode($sessionsArray);
            }
            
        }

    }

    public function userDetails($query)
    {   
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
        
        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        if(Auth::user() == "unactive")
        {
            setcookie('user_email', Auth::user()->getEmail(), time() + 30, "/login", "", false, true);
            header("location: /login?fail=unactive");
            exit();
        }

        if (Auth::user()->getRole_id() != 1) 
        {
            header("location: /profile?forbi=1");
            exit();
        }
        $id = substr($query, 3);

        $user = User::find($id);

        $sessions = $user->sessions();

        require_once "$this->viewPath/Details.php";
    }

    public function delete()
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
        
        if(Auth::user() == false)
        {
            header("location: /login?forbi=1");
            exit();
        }

        if (Auth::user()->getRole_id() != 1) 
        {
            header("location: /profile?forbi=1");
            exit();
        }

        if (isset($_POST)) 
        {
            $id = htmlspecialchars($_POST['id']);

            $user = User::find($id);

            if ($user->getImage()) 
            {
                unlink("assets/".Storage::getUrl($user->getImage()));
            }

            $user->delete();
            header('location: /admin?success=3');

        }

    }

    public function notfound()
    {
        http_response_code(404);
        require_once "$this->viewPath/NotFound.php";

    }

}