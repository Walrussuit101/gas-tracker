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
	
	function logout(){
		unset($User);
		unset($_SESSION['currentUser']);
	}
}
?>
