<?php

namespace Libs\Database;

use PDOException;

class UsersTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO users (name, email, phone, address, password, role_id, created_at)
                      VALUES (:name, :email, :phone, :address, :password, :role_id, NOW() )";
            
            $statement = $this->db->prepare($query);
            $statement->execute($data);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getAll()
    {
        try {
            $statement = $this->db->query("SELECT users.*, roles.name AS role, roles.value
                                           FROM users LEFT JOIN roles
                                           ON users.role_id = roles.id
            ");

            return $statement->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // select user data for login
    public function findByEmail($email)
    {
        $statement = $this->db->prepare("SELECT users.*, roles.name AS role, roles.value
                                         FROM users LEFT JOIN roles ON users.role_id = roles.id
                                         WHERE users.email = :email
        ");

        $statement->execute([
            ':email' => $email
        ]);

        $row = $statement->fetch();

        return $row ?? false;
    }

    //for suspend
    public function suspended($id){
        $statement = $this->db->prepare("SELECT suspended FROM users WHERE id = :id");
        $statement->execute([':id' => $id]);
        $row = $statement->fetch();
        return $row->suspended;
    }

    // for upload photo
    public function updatePhoto($id, $name){
        $statement = $this->db->prepare("UPDATE users SET photo = :name WHERE id = :id");
        $statement->execute([':name' => $name, ':id' => $id]);

        return $statement->rowCount();
    }
}