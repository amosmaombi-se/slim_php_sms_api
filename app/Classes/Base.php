<?php
namespace App\Classes;

abstract class Base extends Files{
    
    protected $db;
    
    public function __construct(){
        parent::__construct();
        $this->db  = Database::connect();
    }


    protected function insert_info($table = "", $fields = []){
        if(($table != "") && (sizeof($fields) > 0)){
            return $this->db->insert($table, $fields);
        }
        return false;
    }

    protected function update_info($table = "", $fields = [], $keys = []){
        if(($table != "") && (sizeof($fields) > 0) && (sizeof($keys) > 0)){
            return $this->db->update($table, $fields, $keys);
        }
        return false;
    }

    protected function query_info($table = "", $where = [], $rows = false){          
        if($table != "" && sizeof($where) > 0){
            $info = $this->db->get($table, $where);
            if($info->count()){
                return ($rows) ? $info->result() : $info->first();
            }
        }      
        return (object)[];
    }

    protected function get_infos($table = "", $where = "", $rows = true){   
        if($table != ""){
         $query = ($where != "") ? "SELECT * FROM $table WHERE $where" : "SELECT * FROM $table";
           // print_r($query);
            $info = $this->db->query($query);
            if($info->count()){
                return ($rows) ? $info->result() : $info->first();
            }
        }      
        return (object)[];
    }

    protected function get_info($table = "", $fields = "", $where = "", $rows = true){
        if(($table != "") && ($fields != "")){
            $query = ($where != "") ? "SELECT $fields FROM $table WHERE $where" : "SELECT $fields FROM $table";
           //print_r($query);
            $data = $this->db->query($query);
            if($data->count()){
                return ($rows) ? $data->result() : $data->first();
            }
        }      
        return (object)[];
    }

    protected function get_field_value($table = "", $field = "", $where = ""){
        if(($table != "") && ($field != "") && ($where != "")){
            $query = "SELECT $field FROM $table WHERE $where";
            $data = $this->db->query($query);
            if($data->count()){
                return $data->first()->$field;
            }
        }      
        return false;
    }


    protected function get_max_value($table, $field, $where = ""){
        if(($table != "") && ($field != "")){
            $where =  ($where != "") ? "WHERE $where" : "";
            $query = $this->db->query("SELECT MAX($field) AS field FROM $table $where");			
            if($query->count()){
                return @$query->last()->field;
            }
        }      
        return 0;        
    }

    protected function count_info($table, $field, $value, $where = ""){
        $where = ($where != "") ? $where : "$field = '$value'";
        $query = $this->db->query("SELECT COUNT($field) AS field FROM $table WHERE $where");
            if($query->count()){
                return @intval($query->first()->field);
            }
        return 0;
    }

    protected function delete_info($table = "", $where = ""){
        if(($table != "") && ($where != "")){
            // echo "DELETE FROM $table WHERE $where";
            $query = $this->db->query("DELETE FROM $table WHERE $where");
            return $query->count();
        }
        return 0;
    }


    protected function get_client_ip(){
        $ip = $_SERVER['REMOTE_ADDR'];
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){    
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];   
        }     
        return $ip;
    }



}