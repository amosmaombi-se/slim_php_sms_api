<?php
namespace App\Controllers; 
use App\Classes\Sms; 

class SmsController extends Sms{

    public function new_sms($request, $response){
        $info = $this->send_sms($request); // -> Class Sms
        return $response->withJson($info);
    }

    public function send_checked($request, $response){
        $info = $this->send_checked_sms($request); // -> Class Sms
        return $response->withJson($info);
    }

    public function get_sms($request, $response){
        $info = $this->get_all_sms($request); // -> Class Sms
        return $response->withJson($info);
    }

    public function sent_sms($request, $response){
        $info = $this->get_sent_sms($request); // -> Class Sms
        return $response->withJson($info);
    }

    public function failed_sms($request, $response){
        $info = $this->get_failed_sms($request); // -> Class Sms
        return $response->withJson($info);
    }
    
}

