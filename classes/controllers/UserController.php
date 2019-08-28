<?php
class UserController{
	private $conn;
	private $User;
	
	function __construct($connSet, $UserSet){
		$this->User = $UserSet;
		$this->conn = $connSet;
	}
	
	function logIn($email, $password){
		$result = $this->conn->prepare("SELECT * FROM users WHERE email = '".$email."'");
		
		//TODO:
		//Implement a prepared statement
								
		$result->execute();
						
		while($row = $result->fetch(PDO::FETCH_ASSOC)){			
			if(password_verify($password, $row["password"])){
				$this->User->setEmail($row["email"]);
				$this->User->setId($row["id"]);
				
				return true;
			}else{
				return false;
			}
		}
		
		return false;
	}
}
?>
