<?php

namespace App\Classes;

class Sms extends Base{
    private $host_name      =   "103.85.213.45";//"dstr.connectbind.com";
    private $port_number    =   "8080";
    private $user_name      =   "ramt-kjym";
    private $user_key       =   "HakunaKu";
    private $sender_name    =   "KJYM";
    private $_sms_table     =   "tb_sms_view";

    public function __construct (){
      parent::__construct();
    }   

    protected function get_all_sms($request){
        $coll_id = $request->getParam('collid');
        return $this->get_infos($this->_sms_table, "coll_id = '$coll_id'", true);
    }

    protected function get_failed_sms($request){
        $coll_id = $request->getParam('collid');
        return $this->get_failed($coll_id);
    }

    protected function get_sent_sms($request){
        $coll_id = $request->getParam('collid');
        return $this->get_sent($coll_id);
    }


    private function get_sent($coll_id){
        return $this->get_infos($this->_sms_table, "coll_id = '$coll_id' AND status = 'sent'", true);        
    }

    private function get_failed($coll_id){
        return $this->get_infos($this->_sms_table, "coll_id = '$coll_id' AND status = 'failed'", true);        
    }

    protected function send_sms($request){
        $csv_file = @$request->getUploadedFiles()['csv_file'];
        $message = [];
        if ($csv_file->getError() === UPLOAD_ERR_OK) {          
             $csv_array = $this->csv_to_array($csv_file->file);
            $message = $this->get_extracted_message($csv_array);        
         }
       return $message;
    }

    protected function send_checked_sms($request){
        $message = $request->getParam('message');
        $sms_info = [];
        $left_sms = [];
        $sms_size = sizeof($message);
        if($sms_size > 0){
            for($k = 0; $k < $sms_size; $k++){
                if($message[$k]['send']){
                    $sent  = $this->send_new_sms($message[$k]);
                    if($sent->status == 'sent' || $sent->status == 'failed'){
                        $sms_info[] =  $sent;
                        if($sent->status == 'failed'){
                            $left_sms[] = $message[$k];
                        }
                    }else{
                        $left_sms[] = $message[$k];
                    }
                }else{
                    $left_sms[] = $message[$k];
                }               
            }
           if(sizeof($sms_info) > 0){
                $saved = $this->save_sent_sms($sms_info);
                return ['status' => 'success', 'message' => 'sms sent successful', 'saved' => $saved, 'left_sms' => $left_sms];
           }       
        }          
        return ['status' => 'failed', 'message' => 'no message found in the file'];
    }

    protected function send_new_sms($content){
        $content = (object) $content;
            $failed_sms = [];
            //prepare to send a message
            $sms = new Sender($this->host_name, $this->port_number, $this->user_name, $this->user_key, $this->sender_name, $content->message, $content->mobile, "0","1"); 
            //sending a message
            $feedback = $sms->Submit();
            $result = explode("|", $feedback);
            //get the response and check if successful
            if(sizeof($result) > 0){
                if($result[0] == "1701"){
                    $content->smsid = $result[2];
                    $content->code  = $result[0];
                    $content->status  = 'sent';
                }else{
                    $content->smsid = $result[2];
                    $content->code  = $result[0];
                    $content->status  = 'failed';
                }
            }else{
                $content->status  = 'not';
            }
            
            
        return $content;   
    }


    protected function csv_to_array($csv_file){
        $csv_to_array = [];

        if (($handle = fopen("{$csv_file}", "r")) !== FALSE) {
         
            while (($data = fgetcsv($handle, 1000, "\r")) !== FALSE) {
                $num = count($data);
                $info = [];
                for ($c=0; $c < $num; $c++) {
                    $info[$c] = explode(",", $data[$c]);        
                }
                $csv_to_array = $info;
            }
    
          fclose($handle);
        }
        return $csv_to_array;
    }
    
    protected function get_extracted_message($csv_array){
        $content = [];
        if(sizeof($csv_array) > 1){
            //assing file titles
            $titles = $csv_array[0];
            //remove file titles and convert to object to process using foreach
            $infos = (object) array_slice($csv_array, 1);
            $x = 0;
            foreach ($infos as $info) {
                $sms = "";
                for($i = 0; $i < sizeof($info); $i++){
                    if($i == 0){
                       // assing the mobile no;
                        $content[$x]['mobile'] = $this->internatinal_mobile_number($info[$i]);
                    }else{
                        //assing the results                 
                        if($i == 1){
                            $content[$x]['regno'] =  $info[$i];
                        }
                        $content[$x]['send'] = 0;

                        $end = ($i == sizeof($info) -1) ? '.' :  ', ';
                        $sms .= $titles[$i] . ':' . $info[$i] . $end;
                    }
                 
                }
                $content[$x]['message'] = $sms;
                $x++;
            }     
        }
        return $content;
    }

    private function internatinal_mobile_number($mobile, $country_code = '255'){
      //"0718 617 461" -> "0718617461"
      $mobile = str_replace(" ", "", $mobile);
      if($mobile){
        if(strlen($mobile) == 9){
            //"718617461" -> "255718617461" 
            return $country_code . $mobile;
        }elseif(strlen($mobile) == 10){
          //"0718617461" -> "255718617461" 
          return $country_code . substr($mobile, 1);
        }elseif(strlen($mobile) == 12 && substr($mobile, 0, 3) == $country_code){
          //no changes needed i.e "255718617461"
          return $mobile;
        }elseif(strlen($mobile) == 13 && substr($mobile, 1, 1) == '+'){
          //"+255718617461" -> "255718617461"
          return  substr($mobile, 1);
        }		
      }
      return false;
    }  
    

    private function  save_sent_sms($sms_info){
        $couter = 0; 
        foreach ($sms_info as $sms) {
           $fields = $this->prepare_new_sms($sms);
           if($this->insert_info($this->_sms_table, $fields)){
            $couter++;
           }         
        }
        return $couter;
    }

    private function prepare_new_sms($sms, $coll_id = 1){
        return [
            'sms_id' => $sms->smsid, 
            'reg_no' => $sms->regno, 
            'mobile' => $sms->mobile, 
            'message' => $sms->message, 
            'time' => date('d-m-Y H:i:s'), 
            'status' => ($sms->code != '1701') ? 'failed' : 'sent', 
            's_code' => $sms->code,
            'coll_id' => $coll_id
        ];
    }

}