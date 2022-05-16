<?php
use App\Controllers\AuthController;

$app->group('/auth', function(){

   // localhost/sms_api/publi/auth/login
    $this->post('/login', AuthController::class . ':user_login');
    $this->post('/logout', AuthController::class . ':user_logout');
    $this->post('/granted', AuthController::class . ':authorized_user');
});
