<?php
use App\Controllers\UserController;

$app->group('/user', function(){
    $this->post('/new', UserController::class . ':new_user');
    $this->post('/change-pass', UserController::class . ':change_password');
});
