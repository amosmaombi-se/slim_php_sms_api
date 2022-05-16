<?php
namespace App\Controllers; 

use App\Classes\User; 

class UserController extends User{

    public function new_user($request, $response){
        $info = $this->registe_user($request); // -> Class User
        return $response->withJson($info);
    }

    public function change_password($request, $response){
        $info = $this->change_password_info($request); // -> Class User
        return $response->withJson($info);
    }
}

