<?php
namespace App\Controllers; 
use App\Classes\User;

class AuthController extends User{

    public function __construct (){
        parent::__construct();
    }

    public function user_login($request, $response){
        $info = $this->login($request); // -> User Class
        return $response->withJson($info);
    }

    public function user_logout($request, $response){
        $info = $this->logout($request); // -> User Class
        return $response->withJson($info);
    }

    public function authorized_user($request, $response){
        $info = $this->authorized_login($request); // -> Class User
        return $response->withJson($info);
    }
    
}