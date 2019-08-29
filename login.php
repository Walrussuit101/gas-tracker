<?php
include_once("headers/header.php");
?>
		
<html>
	<head>
		<meta name=”viewport” content=”width=device-width, initial-scale=1″>
		<title>Log In</title>
		
		<!--BOOTSTRAP/JQUERY CDNs-->
		<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	
		<link rel="stylesheet" href="styles/login.css">
	</head>
	
	<body>
		<div id="content">
			<div id="logInBox" class="container">
				<div class="row">
					<div class="col">			
						<div id="logInFormDiv">			
							<form action="login" method="post" autocomplete="off">
								<input class="logInElement" type="text" name="email" placeholder="Email" autocorrect=off required="required" />
								<input class="logInElement" type="password" name="password" placeholder="Password" required="required"/>
								<button class="btn btn-success logInElement" type="submit" name="login">Log In</button>
								<script>document.getElementsByName("email")[0].focus();</script>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	//TODO:
	//Verify email
	
	if(isset($_POST['login'])){
		$currentUser = new User();
		$currentUserController = new UserController($currentUser);
		
		if($currentUserController->logIn($conn, $_POST['email'], $_POST['password'])){
			$_SESSION['currentUser'] = $currentUser;
			$_SESSION['currentUserController'] = $currentUserController;
			
			header("location: index");
			exit();
			
		}else{
			//TODO:
			//Handle false login, give user feedback
		}
	}
?>
