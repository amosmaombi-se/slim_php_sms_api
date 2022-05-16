<?php
require __DIR__ . '/../private/core/init.php';
require __DIR__ . '/../vendor/autoload.php';


$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ]
]);

require __DIR__ . '/../private/routes/routes.php';




