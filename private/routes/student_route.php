<?php
use App\Controllers\StudentController;

$app->group('/results', function(){
    $this->post('/student',   StudentController::class . ':get_student_results');
    $this->post('/program', StudentController::class . ':get_program_results');
    $this->post('/get-courses', StudentController::class . ':get_course_prog_info');
});


$app->group('/students', function(){
    $this->post('/search',   StudentController::class . ':search_students');  
});

$app->group('/marks', function(){
    $this->post('/new-marks',   StudentController::class . ':process_marks');  
});
//


$app->group('/registration', function(){
   // $this->post('/student',   StudentController::class . ':get_student_results');
    $this->post('/get-programs', StudentController::class . ':get_program');
    $this->post('/get-courses', StudentController::class . ':get_course');
    $this->post('/all', StudentController::class . ':registration');    
    
});