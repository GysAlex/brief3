<?php

namespace App\Models;
use Config\Database;


class Session
{
    private $id;
    private $login_time;
    private $logout_time;
    private $user_id;
    private $pdo;
    
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of login_time
     */ 
    public function getLogin_time()
    {
        return $this->login_time;
    }

    /**
     * Set the value of login_time
     *
     * @return  self
     */ 
    public function setLogin_time($login_time)
    {
        $this->login_time = $login_time;

        return $this;
    }

    /**
     * Get the value of logout_time
     */ 
    public function getLogout_time()
    {
        return $this->logout_time;
    }

    /**
     * Set the value of logout_time
     *
     * @return  self
     */ 
    public function setLogout_time($logout_time)
    {
        $this->logout_time = $logout_time;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function save()
    {
        $query = 'INSERT INTO sessions(login_time, user_id) VALUES(:login_time, :user_id);';
        
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            "login_time" => $this->login_time,
            "user_id" => $this->user_id,
        ]);

        return $this->pdo->lastInsertId();
    }

    public static function find($id)
    {
        $pdo = Database::getConnection();

        $query = 'SELECT * FROM sessions WHERE id=:id;';
        $stmt = $pdo->prepare($query);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);

        $stmt->execute([
            'id' => $id
        ]);

        $session = $stmt->fetch();

        $pdo = null;

        return $session;
        
    }

    public function complete($date)
    {
        $query = 'UPDATE sessions SET logout_time=:logout_time WHERE id=:id;';

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            "id" => $this->id,
            "logout_time" => $date
        ]);
    }

}

