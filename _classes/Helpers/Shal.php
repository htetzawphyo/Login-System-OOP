<?php
namespace Helpers;
// session_start();
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

class Shal
{
    public $token;

    public function __construct(){
        $this->token = sha1(rand(1, 1000) . 'csrf secret');
        $_SESSION['csrf'] = $this->token;
    }
}