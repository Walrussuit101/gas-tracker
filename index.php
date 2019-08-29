<?php
include_once("headers/header.php");

if(!isset($_SESSION['currentUser'])){
	header("location: login");
	exit();
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
				<div class="row">
					<div class="col">
						<div id="mileageFormDiv">
							<label id="inputType"><?php echo displayStatus($_SESSION['currentUser']->inTrip());?></label>
							<form action="index" method="post">
								<input class="milageFormElement" type="number" placeholder="Mileage" name="mileage" required="required"/>
								<button class="btn btn-success milageFormElement" type="submit" name="submitMilage">Submit</button>
								<button class="btn btn-danger milageFormElement" id="logout" type="submit" name="logOut" formnovalidate>Log Out</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	if(isset($_POST['logOut'])){
		$_SESSION['currentUserController']->logout();
		unset($_SESSION['currentUserController']);
		
		header("location: login");
		exit();
	}

	function displayStatus($intrip){
		if($intrip == 1){
			return "Post-Trip Mileage:";
		}else{
			return "Pre-Trip Mileage:";
		}
	}

?>
