<?php session_start();
	//Time initialization
	date_default_timezone_set('Africa/Nairobi');
	
	//global variables initialization	
	$GLOBALS['config'] = array(
		'mysql' => array(
				'hostname'	=> 	'localhost',
				'username'	=>	'root',
				'password'	=>	'',
				'database'	=>	'sms_db'
		), 
		'url' => array(
			'baseUrl'	=> 	'http://localhost:8080/sms_api/public/'
		),
		'folder' => array(
				'public'	=> 	__DIR__ . '/../../public/'
		)
	);

 //initialize global functions
 require_once '../private/functions/senitize.php';
