<?php
class UserController{
	private $User;
	
	function __construct($UserSet){
		$this->User = $UserSet;
	}
	
	function logIn($conn, $email, $password){
		$result = $conn->prepare("SELECT * FROM users WHERE email = '".$email."'");
		
		//TODO:
		//Implement a prepared statement
								
		$result->execute();
						
		while($row = $result->fetch(PDO::FETCH_ASSOC)){			
			if(password_verify($password, $row["password"])){
				$this->User->setEmail($row["email"]);
				$this->User->setId($row["id"]);
				$this->User->setInTrip($row["intrip"]);
				
				return true;
			}else{
				return false;
			}
		}
		
		return false;
	}
	
	function buildUserTripsTable($conn){
		$query = "CREATE TABLE IF NOT EXISTS ".$this->getTableName()." (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id))";
		$query = $conn->prepare($query);
		$query->execute();
		
		$query="ALTER TABLE ".$this->getTableName()." ADD COLUMN IF NOT EXISTS date DATE, ADD COLUMN IF NOT EXISTS startmileage INT(6), ADD COLUMN IF NOT EXISTS endmileage INT(6), ADD COLUMN IF NOT EXISTS totaldistance INT(6)";
		//error_log($query);
		$query=$conn->prepare($query);
		$query->execute();
		
	}
	
	function getTableName(){
		$email = $this->User->getEmail();
		$tablename = substr($email, 0, strpos($email, "@")) . "Trips";
		return $tablename;
	}
	
	function logout(){
		unset($User);
		unset($_SESSION['currentUser']);
	}
}
?>
