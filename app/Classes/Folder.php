<?php 
namespace App\Classes;

   class Folder{

		private static function new_folder($path){
			if(!@file_exists($path)){
				date_default_timezone_set('Africa/Nairobi');
				//$date = date('M d, Y h:i:s A');
				$year = date('Y');
				@mkdir($path, 0777, true);
				$file = @fopen($path.'/index.php','w');
				$content = "<?php \n/************** THE CLAN BOOK ***************\n*********** www.theclanbook.co.tz ***********\n***************  Ⓒ$year KJYM™ ****************/\n\n header('Location: ../');\n?>";
				@fwrite($file, $content);
				@fclose($file);
				return true;
			}
			return false;	
		}

		public static function base_folder(){
			return array('folder' => Config::get('folder/public'), 'url' => Config::get('url/baseUrl'));
		}

// 		public static function images_folder($clan_id){
// 			return array('folder' => self::base_folder()['folder'] . $clan_id . '/images', 'url' => self::base_folder()['url'] . $clan_id . '/images', 'type' => 'image');
// 		}

// 		public static function audios_folder($clan_id){
// 			return array('folder' => self::base_folder()['folder'] . $clan_id . '/audios', 'url' => self::base_folder()['url'] . $clan_id . '/audios', 'type' => 'audio');
// 		}

// 		public static function videos_folder($clan_id){
// 			return array('folder' => self::base_folder()['folder'] . $clan_id . '/videos', 'url' => self::base_folder()['url'] . $clan_id . '/videos', 'type' => 'video');
// 		}

// 		public static function files_folder($clan_id){
// 			return array('folder' => self::base_folder()['folder'] . $clan_id . '/files', 'url' => self::base_folder()['url']  . $clan_id . '/files', 'type' => 'file');
// 		}

		// public static function user_folder($clan_id, $user_id, $type=false){
		// 	return array('folder' => self::base_folder()['folder'] . $clan_id . '/' .  $user_id, 'url' => self::base_folder()['url'] . $clan_id . '/' . $user_id, 'type' => $type);
		// }


		public static function images_folder($clan_id){
			return array('folder' => self::base_folder()['folder'] . $clan_id . '/images', 'url' =>  $clan_id . '/images', 'type' => 'image');
		}

		public static function audios_folder($clan_id){
			return array('folder' => self::base_folder()['folder'] . $clan_id . '/audios', 'url' =>  $clan_id . '/audios', 'type' => 'audio');
		}

		public static function videos_folder($clan_id){
			return array('folder' => self::base_folder()['folder'] . $clan_id . '/videos', 'url' =>  $clan_id . '/videos', 'type' => 'video');
		}

		public static function files_folder($clan_id){
			return array('folder' => self::base_folder()['folder'] . $clan_id . '/files', 'url'  =>  $clan_id . '/files', 'type' => 'file');
		}

		public static function user_folder($clan_id, $user_id, $type = ''){
			return array('folder' => self::base_folder()['folder'] . $clan_id . '/' .  $user_id, 'url' => $clan_id . '/' . $user_id, 'type' => $type);
		}
		
		public static function create_accont_folders($clan_id){
			self::new_folder(self::base_folder()['folder'] . $clan_id);
			self::new_folder(self::images_folder($clan_id)['folder']);
			self::new_folder(self::audios_folder($clan_id)['folder']);
			self::new_folder(self::videos_folder($clan_id)['folder']);
			self::new_folder(self::files_folder($clan_id)['folder']);
			return true;
		}

		public static function create_user_folder($clan_id, $user_id){
			self::new_folder(self::user_folder($clan_id, $user_id)['folder']);
			return true;
		}
		
		public static function deleteAccontFolder($clan_id){
			$folder = self::base_folder()['folder'] . $clan_id;
			if(!file_exists($folder)){
				return false;
			}
			self::erase($folder);
			return true;
		}

		public static function deleteUserFolder($clan_id, $user_id){
			$folder = self::user_folder($clan_id, $user_id)['folder'];
			return $folder;
			if(!file_exists($folder)){
				return false;
			}
			self::erase($folder);
			return true;
		}

		private static function erase($path){
			if(file_exists($path)){
				$files = glob($path . '/*');
				if($files){
					foreach ($files as $file) {
						is_dir($file) ? self::erase($file) : unlink($file);
					}
				}
				rmdir($path);
			}
			return;
		}
	  
		public static function delete_file($file_path){
		  $fullpath = self::base_folder()['folder'] . $file_path;
		  if(file_exists($fullpath)){
			return @unlink($fullpath);
		   }
		  return false;
	  }
}
?>