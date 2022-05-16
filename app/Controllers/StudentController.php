<?php
namespace App\Controllers; 

use App\Classes\Student; 

class StudentController extends Student{

    public function get_student_results($request, $response){
        $info = $this->get_result($request); // -> Class Student
        return $response->withJson($info);
    }

    public function get_program_results($request, $response){
        $info = $this->get_result($request); // -> Class Student
        return $response->withJson($info);
    }

    public function get_course_prog_info($request, $response){
        $info = $this->get_course_program_info($request); // -> Class Student
        return $response->withJson($info);
    }

    public function get_course($request, $response){
        $info = $this->get_course_info($request); // -> Class Student
        return $response->withJson($info);
    }

    public function get_program($request, $response){
        $info = $this->get_program_info($request); // -> Class Student
        return $response->withJson($info);
    }

    public function process_marks($request, $response){
        $info = $this->process_marks_info($request); // -> Class Student
        return $response->withJson($info);
    }

    public function registration($request, $response){
        $info = $this->info_registration($request); // -> Class Student
        return $response->withJson($info);
    }

    public function search_students($request, $response){
        $info = $this->search_students_info($request); // -> Class Student
        return $response->withJson($info);
    }
    

    


    
    

  




    

    


}

