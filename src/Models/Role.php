<?php

namespace App\Models;
use Config\Database;

class Role
{
    private $pdo;
    private $id;
    private $name;

    public function __construct()
    {
        $this->pdo == Database::getConnection();
    }

    /**
     * Get the value of role_id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of role_id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO roles (name) VALUES(:name)";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'name' => $this->name
        ]);

    }

    public static function find($id)
    {
        $pdo = Database::getConnection();

        $query = 'SELECT * FROM roles WHERE id = :id';
        $stmt = $pdo->prepare($query);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);

        $stmt->execute([
            'id' => $id
        ]);

        $role = $stmt->fetch();

        $pdo = null;

        return $role;
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

    public function update($name)
    {
        $query = 'UPDATE roles SET name=:name WHERE id=:id';
        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            'name' => $name
        ]);
    }

    public static function all()
    {
        $pdo = Database::getConnection();
        $query = 'SELECT * FROM roles';
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $roles = $stmt->fetchAll(\PDO::FETCH_CLASS, __class__ );
        $pdo = null;
        return $roles;
    }

}