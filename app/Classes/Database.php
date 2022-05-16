<?php
namespace App\Classes;
use PDO;

 class Database {
 	private static $_instance = null;
 	private $_pdo, $_query, $_error = false, $_results, $_count = 0, $_404 = false;
 	
 	//constructor method for initializing an instance of the database
 	private function __construct() {
 		try{
		$this->_pdo = new PDO(
		'mysql:host=' . Config::get('mysql/hostname') . ';dbname=' . Config::get('mysql/database'), Config::get('mysql/username'), Config::get('mysql/password'));
		    //echo "connected successful";	
		}catch(PDOException $e){
			 //die($e->getMessage());			
			echo "Connection failed";	
			//require_once '/404.php';	
			exit();
		}
 	}
 	
 	//function for database connection 
 	public static function connect(){ 
		if(!isset(self::$_instance)){
			self::$_instance = new Database();
		}
		return self::$_instance;
	}
 	
 	//fuction to prepare a query and querying data from the database
 	public function query($sql, $parameters = array()){
 		$this->_error = false;
 		if($this->_query = $this->_pdo->prepare($sql)){
			$x=1;
			if(count($parameters)){
				foreach($parameters as $param){
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			
			//print_r($this->_query);
			
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
			
		}
		return $this;		
	}
    
    //fuction to prepare a provided query before processing  
	public function action($action, $table, $where = array()){
		if(sizeof($where)== 3){
			$operators = array('=', '<', '>', '<=', '>=', 'LIKE');
			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];
			
			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ";
				if(!$this->query($sql, array($value))->error()){
					return $this;
				 }
			}
		}else{
				$sql = "{$action} FROM {$table}";
				if(!$this->query1($sql)->error()){
					return $this;
				}			
		}
		return false;
	}
	
	//function to query and get data by provinding tablename and where clouse in array
	public function get($table, $where){
			return $this->action('SELECT *', $table, $where);
	}	
	
	//function to delete data from the database by providing table and where clouse in array
	public function delete($table, $where){
		return $this->action('DELETE', $table, $where);
	}
	
	
	//function to insert data to the database by providing table name and fields in array
	public function insert($table, $fields = array()){
			$keys = array_keys($fields);
			$values = '';
			$x = 1;
			foreach($fields as $field){
				$values .= '?';
				if($x < count($fields)){
				  $values .= ', ';	
				}
				$x++;
			}
			
			$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ($values)";	
			
			if(!$this->query($sql, $fields)->error()){
				return true;
			}
		return false;
	}

    //function to update the information by providing table, fields in array and keys in array
	public function update($table, $fields, $keys){
		$set = '';
		$x = 1;
		
		//prepare fiels
		foreach($fields as $name => $value){
			$set .= "{$name} = ?";
			if($x < count($fields)){
				$set .= ', ';
			}
			$x++;
		}		
	
		$key = '';
		$x = 1;
		
		//prepare keys
		foreach($keys as $name => $value){
			$key .= "{$name} = ?";
			if($x < count($keys)){
				$key .= ' AND ';
			}
			$x++;
		}					
		$sql = "UPDATE {$table} SET {$set} WHERE {$key}";	
		//print_r($sql);	
		//print_r($keys);	
		 $fields = array_merge($fields, $keys);
		 
		 //var_dump($fields);
		 // exit(0);

		 if(!$this->query($sql, $fields)->error()){
		 		return $this;
		 }
		return false;
	}
	
	public function error(){
		return $this->_error;
	}
	
	//function to test is something found after querying
	public function count(){
		return $this->_count;
	}
	
	//function to return the observed results from the query
	public function result(){
		return $this->_results;
	}
	
	//function to get the first row of the query result
	public function first(){
		return $this->result()[0];
	}
	
	//function to get the last row of the query result
	public function last(){
		return $this->result()[($this->count()-1)];
	}	
	

} 	

 
 
