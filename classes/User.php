<?php
class User{
	private $id;
	private $email;
	private $intrip;
		
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
	
	public function setInTrip($inTrip){
		$this->intrip = $inTrip;
	}
	
	public function inTrip(){
		return $this->intrip;
	}
}
?>
