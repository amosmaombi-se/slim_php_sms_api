<?php
use App\Controllers\SmsController;

$app->group('/sms', function(){
    $this->post('/send', SmsController::class . ':new_sms');
    $this->post('/checked', SmsController::class . ':send_checked');
    $this->post('/all', SmsController::class . ':get_sms');
    $this->post('/sent', SmsController::class . ':sent_sms');
    $this->post('/failed', SmsController::class . ':failed_sms');
});
