<?php
namespace App\Models;

require_once "../vendor/autoload.php";
use Config\Database;
use App\Models\Role;

class User
{
    private $id;
    private $username;
    private $email;
    private $role_id;
    private $image;
    private $status;
    private $password;
    private $created_at;

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of role_id
     */ 
    public function getRole_id()
    {
        return $this->role_id;
    }

    /**
     * Set the value of role_id
     *
     * @return  self
     */ 
    public function setRole_id($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }


    public static function create(array $arr)
    {
        $pdo = Database::getConnection();
        if (isset($arr['image'])) 
        {
            $query = 'INSERT INTO users(username, email, password, role_id, image) VALUES (:username, :email, :password, :role_id, :image)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'username' => $arr['username'],
                'email' => $arr['email'],
                'password' => password_hash($arr['password'], PASSWORD_BCRYPT),
                'role_id' => $arr['role_id'],
                'image' => $arr['image']
            ]);
        }
        else
        {
            $query = 'INSERT INTO users(username, email, password, role_id) VALUES (:username, :email, :password, :role_id)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'username' => $arr['username'],
                'email' => $arr['email'],
                'password' => password_hash($arr['password'], PASSWORD_BCRYPT),
                'role_id' => $arr['role_id'],
            ]);
        }

        $pdo = null;
    }

    public function clientSave()
    {
        
        if (!isset($this->image)) 
        {
            $query = 'INSERT INTO users(username, email, password) VALUES (:username, :email, :password)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'username' => $this->username,
                'email' => $this->email,
                'password' => password_hash($this->password, PASSWORD_BCRYPT),
            ]);
        }

        else
        {
            $query = 'INSERT INTO users(username, email, password) VALUES (:username, :email, :password, :image)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'username' => $this->username,
                'email' => $this->email,
                'password' => password_hash($this->password, PASSWORD_BCRYPT),
                'image' => $this->image
            ]);
        }

    }


    public function save()
    {

        if (!isset($this->image)) 
        {
            $query = 'INSERT INTO users(username, email, password, role_id) VALUES (:username, :email, :password, :role_id)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'username' => $this->username,
                'email' => $this->email,
                'password' => password_hash($this->password, PASSWORD_BCRYPT),
                'role_id' => $this->role_id
            ]);
        }

        else
        {
            $query = 'INSERT INTO users(username, email, password, role_id) VALUES (:username, :email, :password, :role_id, :image)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'username' => $this->username,
                'email' => $this->email,
                'password' => password_hash($this->password, PASSWORD_BCRYPT),
                'role_id' => $this->role_id,
                'image' => $this->image
            ]);
        }

    }

    public static function all()
    {
        $pdo = Database::getConnection();
        $query = 'SELECT * FROM users';
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $users = $stmt->fetchAll(\PDO::FETCH_CLASS, __class__ );
        $pdo = null;
        return $users;
    }

    public static function find($id)
    {
        $pdo = Database::getConnection();

        $query = 'SELECT * FROM users WHERE id = :id';
        $stmt = $pdo->prepare($query);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);

        $stmt->execute([
            'id' => $id
        ]);

        $user = $stmt->fetch();

        $pdo = null;
        return $user;
    }

    public static function findByEmail($email)
    {
        $pdo = Database::getConnection();

        $query = 'SELECT * FROM users WHERE email = :email';
        $stmt = $pdo->prepare($query);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch();
        $pdo = null;
        return $user;   
    }

    public function delete()
    {
        $query = 'DELETE FROM users WHERE id = :id';
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            "id" => $this->id
        ]);

        return $this;
    }


    public function updatePassword($newPassword)  
    {
        $query = "UPDATE users SET password=:password WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            "password" => password_hash($newPassword, PASSWORD_BCRYPT),
            "id" => $this->id,
        ]);
    }


    public function clientUpdate(array $arr)
    {
        if(isset($arr['image']))
        {
            $query = "UPDATE users SET username=:username, email=:email, image=:image WHERE id=:id";
            $stmt = $this->pdo->prepare($query);
    
            $stmt->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
            $stmt->execute([
                "username" => $arr['username'],
                "email" => $arr["email"],
                "image" => $arr['image'],
                "id" => $this->id,
            ]);
        }

        else
        {
            $query = "UPDATE users SET username=:username, email=:email WHERE id=:id";
            $stmt = $this->pdo->prepare($query);
    
            $stmt->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
    
            $stmt->execute([
                "username" => $arr['username'],
                "email" => $arr["email"],
                "id" => $this->id,
            ]);
        }
        return $this;
    }


    public function update(array $arr)
    {
        
        if(isset($arr['image']))
        {
            $query = "UPDATE users SET username=:username, email=:email, password=:password, role_id=:role_id, status=:status, image=:image WHERE id=:id";
            $stmt = $this->pdo->prepare($query);
    
            $stmt->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
            $stmt->execute([
                "username" => $arr['username'],
                "email" => $arr["email"],
                "password" => password_hash($arr['password'], PASSWORD_BCRYPT),
                "role_id" => $arr['role_id'],
                "image" => $arr['image'],
                "status" => $arr['status'],
                "id" => $this->id,
            ]);
        }

        else
        {
            $query = "UPDATE users SET username=:username, email=:email, password=:password, status=:status, role_id=:role_id WHERE id=:id";
            $stmt = $this->pdo->prepare($query);
    
            $stmt->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
    
            $stmt->execute([
                "username" => $arr['username'],
                "email" => $arr["email"],
                "password" => password_hash($arr['password'], PASSWORD_BCRYPT),
                "role_id" => $arr['role_id'],
                "status" => $arr['status'],
                "id" => $this->id,
            ]);
        }
        return $this;
    }

    public static function resetIncrement()
    {
        $pdo = Database::getConnection();
        $query = 'ALTER TABLE users AUTO_INCREMENT=3';
        $stmt = $pdo->query($query);
        
        $pdo = null;
    }


    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function roleName()
    {
        $role = Role::find($this->role_id);
        return $role->getName();
    }

    public function sessions()
    {

        $query = 'SELECT * FROM sessions WHERE user_id=:user_id';

        $stmt = $this->pdo->prepare($query);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, Session::class);

        $stmt->execute([
            "user_id" => $this->id,
        ]);

        $sessions = $stmt->fetchAll();

        return $sessions;
    }

    public function lastSession()
    {
        $query = 'SELECT * FROM sessions WHERE user_id=:user_id';

        $stmt = $this->pdo->prepare($query);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, Session::class);

        $stmt->execute([
            "user_id" => $this->id
        ]);

        $session = $stmt->fetch();

        return $session;
    }
}



// $user->setUsername('alex2');
// $user->setEmail('alex@admin2.com');
// $user->setPassword('alex');
// $user->setRole_id(1);

// $user->save();


 