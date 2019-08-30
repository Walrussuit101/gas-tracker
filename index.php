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
			<script src="scripts/tripNotifications.js"></script>
	</head>
	
	<body>
		<div id="content">
			<div class="container">
				<div class="notification tripSaved">
					<p>Trip Saved</p>
					</br>
					<p id="startMileageNotification"></p>
				</div>
				
				<div class="notification tripEnded">
					<p>Trip Ended</p>
					</br>
					<p id="totalDistanceNotification"></p>
				</div>
				
				<div id="mainrow" class="row main">
					<div id="maincol" class="col main">
						<div id="mileageFormDiv">
							<label id="inputType"><?php echo displayStatus($_SESSION['currentUser']->inTrip());?></label>
							<form action="index" method="post">
								<input class="milageFormElement" type="number" placeholder="Mileage" name="mileage" required="required"/>
								<button class="btn btn-success milageFormElement" type="submit" name="submitMileage">Submit</button>
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
	if(isset($_SESSION['justSaved']) && isset($_SESSION['startMileage'])){
		echo "<script>notifyTripSaved(".$_SESSION['startMileage'].");</script>";
		unset($_SESSION['justSaved']);
		unset($_SESSION['startMileage']);
	}else if(isset($_SESSION['justEnded']) && isset($_SESSION['totalDistance'])){
		echo "<script>notifyTripEnded(".$_SESSION['totalDistance'].");</script>";
		unset($_SESSION['justEnded']);
		unset($_SESSION['totalDistance']);
	}



	if(isset($_POST['logOut'])){
		$_SESSION['currentUserController']->logout();
		unset($_SESSION['currentUserController']);
		
		header("location: login");
		exit();
	}else if(isset($_POST['submitMileage'])){		
		if($_SESSION['currentUser']->inTrip() == 1){
			$totaldistance = $_SESSION['currentUserController']->saveEndMileageAndDistance($conn, $_POST['mileage']);
			$_SESSION['currentUserController']->endTrip($conn);
			$_SESSION['justEnded'] = true;
			$_SESSION['totalDistance'] = $totaldistance;
			header("Refresh: 0");
		}else{
			$_SESSION['currentUserController']->saveStartMileage($conn, $_POST['mileage'], $date);
			$_SESSION['justSaved'] = true;
			$_SESSION['startMileage'] = $_POST['mileage'];
			header("Refresh: 0");
		}
	}

	function displayStatus($intrip){
		if($intrip == 1){
			return "Post-Trip Mileage:";
		}else{
			return "Pre-Trip Mileage:";
		}
	}
?>
