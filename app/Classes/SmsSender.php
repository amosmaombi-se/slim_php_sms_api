<?php
namespace App\Classes;

class SmsSender{
	private $host, $port, $strUserName, $strPassword, $strSender, $strMessage, $strMobile, $strMessageType, $strDlr;
	
	//Constructor..
	public function __construct ($host,$port,$username,$password,$sender, $message,$mobile, $msgtype,$dlr){
		$this->host=$host;
		$this->port=$port;
		$this->strUserName = $username;
		$this->strPassword = $password;
		$this->strSender= $sender;
		$this->strMessage=$message; //URL Encode The Message..
		$this->strMobile=$mobile;
		$this->strMessageType=$msgtype;
		$this->strDlr=$dlr;
	}

	private function sms__unicode($message){
		$hex1='';
		if (function_exists('iconv')) {
			$latin = @iconv('UTF-8', 'ISO-8859-1', $message);
			if (strcmp($latin, $message)) {
				$arr = unpack('H*hex', @iconv('UTF-8', 'UCS-
				2BE', $message));
				$hex1 = strtoupper($arr['hex']);
			}
			if($hex1 ==''){
				$hex2='';
				$hex='';
				for ($i=0; $i < strlen($message); $i++){
					$hex = dechex(ord($message[$i]));
					$len =strlen($hex);
					$add = 4 - $len;
					if($len < 4){
						for($j=0;$j<$add;$j++){
						$hex="0".$hex;
						}
					}
					$hex2.=$hex;
				}
				return $hex2;
			}
			else{
				return $hex1;
			}
		}
		else{
			print 'iconv Function Not Exists !';
		}
	}

	protected function Submit(){
	    @header('Content-Type: text/plain; charset=utf-8');
		if($this->strMessageType=="2" || $this->strMessageType=="6") {
			//Call The Function Of String To HEX.
			$this->strMessage = $this->sms__unicode($this->strMessage);
			try{
				//Smpp http Url to send sms.
				 $live_url="http://".$this->host.":".$this->port."/sendsms?username=".$this->strUserName."&password=".$this->strPassword."&type=".$this->strMessageType."&dlr=".$this->strDlr."&destination=".$this->strMobile."&source=".$this->strSender."&message=".$this->strMessage."";
				$parse_url = @file($live_url);
				return $parse_url[0];
			}catch(Exception $e){
				return 'Message:' .$e->getMessage();
			}
		}
		else
			$this->strMessage = urlencode($this->strMessage);
		try{
			//Smpp http Url to send sms.
			$live_url = "http://".$this->host.":".$this->port."/sendsms?username=".$this->strUserName."&password=".$this->strPassword."&type=".$this->strMessageType."&dlr=".$this->strDlr."&destination=".$this->strMobile."&source=".$this->strSender."&message=".$this->strMessage."";
			$parse_url = @file($live_url);
			return $parse_url[0];
		}
		catch(Exception $e){
			return 'Message:' .$e->getMessage();
		}
	}
}