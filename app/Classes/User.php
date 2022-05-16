<?php
namespace App\Classes;

class User extends Base{
    
    private $_user_table =  "tb_users", 
            $_auth_table =  "tb_auth", 
            $_token;

    public function __construct (){
            parent::__construct();
            $this->_token = new Token;
    }        
   
    protected function login($request){
        $username = $request->getParam('username');
        $password = $request->getParam('password');
        $remember = $request->getParam('remember');

       $infos = $this->get_infos($this->_user_table, "username = '$username'", false);

        if(!empty((array) $infos)){
            $real_password = $infos->password;
            $password = $this->get_hashed_password($password, $infos->hash);//$infos->user_id, 
            //echo $password . "===" . $real_password;
            
            if($password === $real_password){
                $expire = ($remember) ? (2592000) : (86400); 
                $login_info = $this->get_info($this->_user_table, "user_id, username, fname, lname", "username = '$username'", false);
                $token = $this->set_auth($login_info->user_id, $expire);
                return ['status' => 'success', 'info' => ['info' => $login_info, 'token' => $token]];
            }
    
        }
     return ['status' => 'failed', 'message' => "Wrong username or password"];
    }

    protected function authorized_login($request){
        $user_id = $request->getParam('userid');
        $token   = $request->getParam('token');       
        $status  = $this->authorization($user_id, $token);
        if($status == 1){
            return 1;
        }
        return 0;
    }

    private function authorization($user_id, $token){
        $auth_info = $this->get_auth($user_id);
        if(!empty((array) $auth_info)){
            $real_hashed_token = $auth_info->token;
            $hashed_token = $this->hashed_token($user_id, $token);
            if($real_hashed_token === $hashed_token){
                return 1;  
                //return ['status' => 'success', 'message' => "access granted"]; 
            }else{
                //delete auth to avoid attack
                $this->clear_auth($user_id);
                return 2;
                //return ['status' => 'failed', 'message' => "cross attack trial"];
            }
            
        }
        return 0;
        //return ['status' => 'failed', 'message' => "access deniel"];
    }

    private function get_login_info($userd){
        return $this->get_info($this->_user_table, "password, hash", "user_id = '$userd'", false);
    }

    protected function registe_user($request){
        $fields = $this->prepare_new_user($request);
        if($this->insert_info($this->_user_table, $fields)){
            return ['status' => 'success', 'message' => "Registered successful"]; 
        }
        return ['status' => 'failed', 'message' => "Failed tos register"];
    }

    protected function logout($request){
        $user_id = $request->getParam('userid');
        $this->clear_auth($user_id);
        return ['status' => 'success', 'message' => "user logged out"];
    }


    private function get_hashed_password($password, $hash, $user_id = 'sms'){
        return  Hash::make($password . $user_id, $hash);
    }

    private function prepare_new_user($req){
        $hash = Hash::salt(32);
        $password  = $this->get_hashed_password($req->getParam('pass'), $hash);
        return [
            'user_id' => null, 
            'username' => $req->getParam('uname'), 
            'fname' => $req->getParam('fname'), 
            'lname' => $req->getParam('lname'), 
            'password' => $password , 
            'hash'  => $hash, 
            'call_number' => $req->getParam('callid')
        ];

    }

    protected function change_password_info($request){
        $pass1 = $request->getParam('cpass');
        $pass2 = $request->getParam('npass');
        $pass3 = $request->getParam('copas');
        if($pass2 === $pass3){
            $u_id = $request->getParam('userid');
            
            $info = $this->get_login_info($u_id);
            
            $real_cur_pass = $info->password;

            $curpass = $this->get_hashed_password($pass1, $info->hash); 

            if($real_cur_pass ===  $curpass){
                $hash =  Hash::salt(32);
                $pass = $this->get_hashed_password($pass1, $hash);
    
                $fields = ['password' => $pass ,'hash'  => $hash];
                if($this->update_info($this->_user_table,  $fields, ['user_id' => $u_id])){
                    return ['status' => 'success', 'message' => "Password changes successful"]; 
                }
                return ['status' => 'failed', 'message' => "Failed to change password"];                
            }
            return ['status' => 'failed', 'message' => "Current password does not match"];   

        }
        return ['status' => 'failed', 'message' => "Password does not match"]; 
    }

    private function set_auth($user_id, $expire){
        $token  = $this->_token->generate();
        $expire = strtotime(date("Y-m-d H:i:s")) + $expire;
        $hashed =  $this->hashed_token($user_id, $token);
        $sha_id = SHA1($user_id);
        $fields = ['auth' => $sha_id, 'token' => $hashed, 'expire' => $expire];
        $this->clear_auth($user_id);
        if($this->insert_info($this->_auth_table, $fields)){
            return $token;
        }
        return false;
    }

    private function get_auth($user_id){
        $this->clear_auth();
        return $this->get_infos($this->_auth_table, "auth = '".SHA1($user_id)."'", false);
    }

    private function clear_auth($user_id = ""){
        if($user_id != ""){
            $this->delete_info($this->_auth_table, "auth = '" . SHA1($user_id) . "'");
        }  
        $expire = strtotime(date("Y-m-d H:i:s"));
        $this->delete_info($this->_auth_table, "expire <= '$expire'");   
        return true;
    }

    private function hashed_token($user_id, $token){
        return Hash::make($user_id, $token);
    }



}
