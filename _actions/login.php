<?php

session_start();

include "../vendor/autoload.php";

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

if($_GET['csrf'] !== $_SESSION['csrf']){
    HTTP::redirect("/index.php", "incorrect=1");
}

$email = $_POST['email'];
$password = $_POST['password'];

$table = new UsersTable(new MySQL() );

$user = $table->findByEmail($email);

if ( $user->email == $email && password_verify($password, $user->password) )
{
    if($table->suspended($user->id)) {
        HTTP::redirect("/index.php", "suspended=1");
    }

    $_SESSION['user'] = $user;
    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/index.php", "incorrect=1");
}