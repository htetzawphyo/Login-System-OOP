<?php
session_start();
include "../vendor/autoload.php";

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$table = new UsersTable(new MySQL() );

if($_POST['csrf'] !== $_SESSION['csrf']){
    HTTP::redirect("/register.php", "error=true");
}
    if(isset($_POST)){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        if ( empty($name) || empty($email) || empty($phone) || empty($address) || empty($password) )
        {
            HTTP::redirect("/register.php", "valiError=true");
        }else {
            $user = $table->findByEmail($email);
            if($user->email == $email) {
                HTTP::redirect("/register.php", "emailError=true");
            }
            $data = [
                "name" => $name ?? 'Unknown',
                "email" => $email ?? 'Unknown',
                "phone" => $phone ?? 'Unknown',
                "address" => $address ?? 'Unknown',
                "password" => password_hash($password, PASSWORD_BCRYPT),
                "role_id" => 1,
            ];
            
            $table = new UsersTable(new MySQL());
            
            if($table) {
                $table->insert($data);
                HTTP::redirect("/index.php", "registered=true");    
            } else {
                HTTP::redirect("/register.php", "error=true");
            }
        }
    }




