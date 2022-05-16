<?php
namespace App\Classes;

class Files{

    public function __construct(){
       
    }
    
    protected function save_file($file, $user_id, $clan_id, $private = false){    
        $status  =  $new_name  = $original_name = '';
        if ($file->getError() === UPLOAD_ERR_OK) {          
            //preparation on saving loaded file
            $status     =  'notaccepted'; 
            $file_name 	= 	$file->getClientFilename();
            //create new file name
            $basename 	= 	bin2hex(random_bytes(8));
            $extension 	=   pathinfo($file_name, PATHINFO_EXTENSION);
            $new_name 	= 	time().sprintf('%s.%0.8s', $basename, $extension);
            //test if loaded file is acceptable
            if(in_array(strtolower($extension), $this->accepted_extension())){
                $save_to  = $this->get_folder_path($extension, $clan_id, $user_id, $private);
                $status =  'failed';
                //save loaded file to required destination  
               
                if(@move_uploaded_file($file->file, $save_to['folder'] .'/'. $new_name)){
                        //prepare success returns
                        $status = 'success';
                        $file   = explode('.', $file_name);
                        $filetype = $save_to['type'];
                        //check if the original file length is greater than 50 characters to append ...
                        $file_name = (strlen($file[0]) > 50) ? (substr($file[0], 0, 47).'...') : ($file[0]);  

                    return array('filename' => $file_name,'baseurl' => Folder::base_folder()['url'], 'url' => $save_to['url'] .'/'. $new_name, 'filetype' => $filetype);   //$save_to['url'] .'/'.  
                }             
            }
         }
        return array('filename' => '','baseurl' => '', 'url' => '','filetype' => '');
     
    }

    protected function get_folder_path($extension, $clan_id, $user_id, $private){   
        $ext = strtolower($extension);
        if($user_id && $clan_id && $private){
            $type = "";
            if(in_array($ext, $this->extensions()['images'])){
                $type = "image";
             }elseif(in_array($ext, $this->extensions()['audios'])){
                $type = "audio";
             }elseif(in_array($ext, $this->extensions()['videos'])){
                $type = "video";           
             }else{
                $type = "file";          
             }
             return Folder::user_folder($clan_id, $user_id, $type);
        }

        if(in_array($ext, $this->extensions()['images'])){
           return Folder::images_folder($clan_id);
        }elseif(in_array($ext, $this->extensions()['audios'])){
            return Folder::audios_folder($clan_id);
        }elseif(in_array($ext, $this->extensions()['videos'])){
            return Folder::videos_folder($clan_id);            
        }else{
            return Folder::files_folder($clan_id);            
        }
    }

    private function extensions(){
        return array(
                'files'    =>  array('pdf','doc','docx','xls','xlsx','ppt','pptx','zip','rar','txt','zip'),
                'images'   =>  array('jpeg','jpg','gif','png'), 
                'audios'   =>  array('wav','mp3','wma'), 
                'videos'   =>  array('avi','flv','wmv','mp4','mov'), 
                );
    } 
    
    private function accepted_extension(){
      $ext = array();
         foreach ($this->extensions() as $exts) {
                $ext = array_merge($ext, $exts);
            }
      return $ext;
    }

    protected function delete_file($file_path){ 
        return Folder::delete_file($file_path);
    }

    
}