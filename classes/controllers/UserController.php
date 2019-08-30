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
				$this->User->setCurrentTripId($row["currenttripid"]);
				
				return true;
			}else{
				return false;
			}
		}
		
		return false;
	}
	
	function refresh($conn){
		$result = $conn->prepare("SELECT * FROM users WHERE id = ".$this->User->getId());								
		$result->execute();
		
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$this->User->setEmail($row["email"]);
			$this->User->setInTrip($row["intrip"]);
			$this->User->setCurrentTripId($row["currenttripid"]);
		}
	}
	
	function buildUserTripsTable($conn){
		$query = "CREATE TABLE IF NOT EXISTS ".$this->getTableName()." (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id))";
		$query = $conn->prepare($query);
		$query->execute();
		
		$query="ALTER TABLE ".$this->getTableName()." ADD COLUMN IF NOT EXISTS date DATE, ADD COLUMN IF NOT EXISTS startmileage INT(6), ADD COLUMN IF NOT EXISTS endmileage INT(6), ADD COLUMN IF NOT EXISTS totaldistance INT(6)";
		$query=$conn->prepare($query);
		$query->execute();
	}
	
	function saveStartMileage($conn, $startMileage, $date){
		
		$table = $this->getTableName();
				
		$query = "INSERT INTO ".$table." (startmileage, date) VALUES(".$startMileage.", '".$date."')";
		$result = $conn->prepare($query);
		$result->execute();
		$tripid = $conn->lastInsertId();
		
		$query = "UPDATE users SET currenttripid = ".$tripid.", intrip = 1 WHERE id = ".$this->User->getId();
		$result = $conn->prepare($query);
		$result->execute();
		
		$this->refresh($conn);
	}
	
	function saveEndMileageAndDistance($conn, $endMileage){
		
		$table = $this->getTableName();
		$currentTripId = $this->User->getCurrentTripId();
		
		$query = "UPDATE ".$table." SET endmileage = ".$endMileage." WHERE id = ".$currentTripId;
		$result = $conn->prepare($query);
		$result->execute();
		
		$query = "SELECT startmileage FROM ".$table." WHERE id =".$currentTripId;
		$result = $conn->prepare($query);
		$result->execute();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$startMileage = $row['startmileage'];
		}
		
		$totaldistance = $endMileage - $startMileage;
		
		$query = "UPDATE ".$table." SET totaldistance = ".$totaldistance." WHERE id = ".$currentTripId;
		$result = $conn->prepare($query);
		$result->execute();
		
		$this->refresh($conn);
		
		return($totaldistance);
	}
	
	function endTrip($conn){
		$query = "UPDATE users SET intrip = NULL, currenttripid = NULL WHERE id = ".$this->User->getId();
		$result = $conn->prepare($query);
		$result->execute();
		
		$this->refresh($conn);
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
