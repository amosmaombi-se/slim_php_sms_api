<?php

namespace App\Classes;

class Student extends Base{

    private $_tb_hotel_view = 'tb_hotel_mgt_view';
    private $_tb_childcare_view = 'tb_childcare_education_view';
    private $_tb_ict_view = 'tb_ict_view';
    private $_tb_student = 'tb_student';
    private $_tb_course_view = 'tb_course_view';
    private $_tb_course = 'tb_course';
    private $_tb_program = 'tb_program';   

    private $_tb_hotel_mgt = 'tb_hotel_mgt';    


    public function __construct (){
      parent::__construct();
    }   
   
    public function new_student($request){

        return true;
    }

    public function get_result($request){

        $what = $request->getParam('what');

        if($what == 'program'){

            $type = $request->getParam('type');
            $reg_no = $request->getParam('reg_no');
            $where = "";
            
            $where = ($type == 'test') ? ("month = {$request->getParam('month')} AND year = {$request->getParam('year')} AND type = '{$type}'") : ("year = {$request->getParam('year')} AND type = '{$type}'");
            $prog_id = $request->getParam('prog_id');

            return $this->get_results_info($prog_id, $where);


        }elseif($what == 'student'){

            $type = $request->getParam('type');
            $reg_no = $request->getParam('reg_no');
            $where = "reg_no = '{$reg_no}'";
            
            if($type == 'test'){
                $where .= " AND (month BETWEEN {$request->getParam('from')} AND {$request->getParam('to')})";
            }else{
                $where .= " AND month = {$request->getParam('from')}"; 
            }
            $year = $request->getParam('year');
             $where .= " AND year = {$year} AND type = '{$type}'";

             $info =  $this->get_student_info($reg_no);
            
             if(!empty((array) $info)){
                 return $this->get_results_info($info->program_id, $where);
             }
            return ['status' => 'failed', 'info' => 'not found'];
           
        }

        
    }

    private function get_results_info($prog_id, $where){
        $status = 'failed';     
        switch ($prog_id) {

            case 'PROG001': //Busness Operation Assistant in Busness Adminstration

            break;
            case 'PROG002': //Busness Operation Assistant in Busness Finance & Accounting

            break;
            case 'PROG003': //Busness Operation Assistant in Procument & Supply

            break;
            case 'PROG004': //Busness Operation Assistant in Banking

            break;
            case 'PROG005': //Information & Communicatins Technology
            $infos = $this->get_infos($this->_tb_ict_view, $where);
            break;
            case 'PROG006': //ChildCare & Education
            $infos = $this->get_infos($this->_tb_childcare_view, $where);
            break;
            case 'PROG007': //Fron Office Operations in Hotel Management
            $infos = $this->get_infos($this->_tb_hotel_view, $where);
            break;
            case 'PROG008': //Fron Office Operations

            break;
            case 'PROG009': //Tourism & Hospitality Management

            break;
            case 'PROG010': //Electical Inastallation

            break;
            case 'PROG011': //English Language

            break;
            case 'PROG012': //Computer Applications

            break;
            default:
                # code...
                break;
           }

           if(!empty((array) $infos)){
               $status = 'success';
           }


           return ['status' => $status, 'info' => $infos];
    }

    public function process_marks_info($request){
        $marks  = $request->getParam('marks');
        $kind   = $request->getParam('kind');
        $status = $request->getParam('status');
        $type   = $request->getParam('type');     
        $month  = $request->getParam('month');
        $year   = $request->getParam('year');
        $marks_info = [];
        $i = 0;
        array_pop($marks); 
        foreach ($marks as $mark) {
            $field = (object) $mark;
            if(($status == 'fresh') || ($status == 'test')){    
                $field = (array) $field;
                if($status == 'fresh'){
                    $field->month  = $month;
                    $field->year   = $year;
                    $field->type   = $kind;
                    if($this->save_marks($this->_tb_hotel_mgt, $field)){
                        $i++;
                    }                 
                }elseif($status == 'test'){
                    $keys = ['std_id' => $field['std_id'], 'month' => $month,'year' => $year,'type' => 'test'];
                    unset($field['std_id']);
                    if(!$this->update_saved_marks($this->_tb_hotel_mgt, $field, $keys)){
                        $regno = ['std_id' => $field['std_id']];
                        $field = array_merge($field, $regno);
                        if($this->save_marks($this->_tb_hotel_mgt, $field)){
                            $i++;
                        }                     
                    }else{
                        $i++;
                    }                  
                }
            }elseif($status == 'sup'){
                $keys = ['std_id' => $field->std_id,'month' => $month,'year' => $year,'type' => 'exam'];
                $field = (array) $field;
                unset($field['std_id']);
                if($this->update_saved_marks($this->_tb_hotel_mgt, $field, $keys)){
                    $i++;
                }
            }

        }
       
        return ['status' => 'success', 'saved' => $i];
    }

    private function save_marks($table, $fields){
        return $this->insert_info($table, $fields);
    }

    private function update_saved_marks($table, $fields, $keys){
         return $this->update_info($table, $fields, $keys);
     }

    public function get_student_info($reg_no){
        return $this->get_infos($this->_tb_student, "reg_no = '$reg_no'", false);
    }

    public function search_students_info($request){
        $prog_id = $request->getParam('prog_id');
        $where  = "program_id = '$prog_id'";    
        return $this->get_infos($this->_tb_student, $where);
    }
    
    public function get_course_program_info($request){
        $prog_id = $request->getParam('prog_id');
        return $this->get_course_program($prog_id);
    }

    public function get_course_info($request){
        $prog_id = ($request->getParam('prog_id')) ? ($request->getParam('prog_id')) : ('');
        return $this->get_courses($prog_id);
    }

    public function get_program_info($request){
        return $this->get_programs();
    }


    private function get_course_program($prog_id){
        return $this->get_infos($this->_tb_course_view, "prog_id = '$prog_id'");
    }

    private function get_courses($prog_id){
        $where = ($prog_id != '') ? ("prog_id = '$prog_id'") : ('');
        return $this->get_infos($this->_tb_course_view, $where);
    }

    private function get_programs(){
        return $this->get_infos($this->_tb_program);
    }

    private function get_max_programs_id(){
        return $this-> get_max_value($this->_tb_program, 'prog_id');
    }

    private function save_data($table, $fields){
        return $this->insert_info($table, $fields);
    }

    protected function info_registration($request){
        $what = $request->getParam('what');
        $info = (object)[];
        switch ($what) {
            case 'program':
                $info = $this->save_new_program($request);
                break;
            case 'course':
                $info = $this->save_new_course($request);
                break;
            case 'students':
                $info = $this->save_new_student($request);
                break;
            
            default:
                # code...
                break;
        }

        return  ($info) ? ['status'=>'success'] : ['status'=>'failed'];
    }

    private function save_new_program($req){
        $fields = [
            'prog_id' => $this->new_program_id(),
            'name' => $req->getParam('prog_name'),
            's_name' => $req->getParam('prog_sname'),
            'length' => $req->getParam('prog_length'),
            'l_unit' => $req->getParam('prog_unit'),
            'description' => $req->getParam('prog_descr'),
        ];
        return $this->insert_info($this->_tb_program, $fields);
    }

    private function save_new_course($req){
        $fields = [
            'c_code' => $req->getParam('c_code'),
            'c_name' => $req->getParam('c_name'),
            'c_shortname' => $req->getParam('c_sname'),
            'c_description' => $req->getParam('descr')
        ];
        return $this->insert_info($this->_tb_course, $fields);  
    }

    private function save_new_student($req){
        
    }

    private function new_program_id(){
        $new_id = 'PROG';
        $max_prog_id = $this->get_max_programs_id();
        if($max_prog_id){
            $prog_id = intval(substr($max_prog_id, 4)) + 1;
            $new_id .= ($prog_id < 10) ? ('00'.$prog_id) : (($prog_id < 100) ? ('0'.$prog_id) : ($prog_id));
        }else{
            $new_id .= '001';
        }
        return $new_id;
    }

}

