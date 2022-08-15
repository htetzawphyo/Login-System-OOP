<?php

namespace Libs\Database;

use PDO;
use PDOException;

class MySQL
{
    public function __construct(
        private $dbhost = "localhost",
        private $dbuser = "root",
        private $dbname = "login_system_oop",
        private $dbpass = "",
        private $db = null
    ){}

    public function connect()
    {
        try {
            $this->db = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname",
                             $this->dbuser,$this->dbpass,
                             [
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                             ]
            );
            return $this->db;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    } 
}