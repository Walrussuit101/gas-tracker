<?php
class User{
	private $id;
	private $email;
		
	public function getEmail(){
		return $this->email;
	}	
	
	public function setEmail($emailSet){
		$this->email = $emailSet;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($idSet){
		$this->id = $idSet;
	}
}
?>
