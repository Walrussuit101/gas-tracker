<?php
include_once("headers/header.php");

if(!isset($_SESSION['currentUser'])){
	header("location: login");
	exit();
}else{
	echo $_SESSION['currentUser']->getEmail();
	echo $_SESSION['currentUser']->getId();
}
?>
<html>
	<head>
			<title>Test</title>
			
			<!--BOOTSTRAP/JQUERY CDNs-->
			<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	
			<link rel="stylesheet" href="styles/index.css">
	</head>
	
	<body>
		<div id="content">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm">
						<p>TEST</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
