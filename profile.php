<?php require_once("Include/DB.php");  ?>
<?php require_once("Include/Sessions.php");  ?>
<?php require_once("Include/Functions.php");  ?>
<?php

if(isset($_POST["Submit"])){

$Password=mysqli_real_escape_string($connectingDB,($_POST["Password"]));
$ConfirmPassword=mysqli_real_escape_string($connectingDB,($_POST["ConfirmPassword"]));

if(empty($Password)||empty($ConfirmPassword)){
	$_SESSION["message"]="All Fields must be filled out";
}elseif($Password!==$ConfirmPassword){
	$_SESSION["message"]="Both Password Values must be Same";
	
}elseif(strlen($Password)<4){
	$_SESSION["message"]="Password Should Include at least 4 values";
	
}
else{
	global $connectingDB;
	$Hashed_Password=Password_Encryption($Password);
	$Query="UPDATE admin SET password='$Hashed_Password'";
$Execute=mysqli_query($connectingDB,$Query);
if($Execute){
	    $_SESSION["SuccessMessage"]="Password Changed Successfully";
		Redirect_To("login.php");
}else{
		$_SESSION["message"]="Something Went Wrong Try Again!";
	        Redirect_To("profile.php");
}

	
	
}

	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>hotelbookings-flightbookings-holidayspackages</title>
	<link rel="stylesheet" href="css/materialize.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/login.css">
	<script src='js/main.js'></script>


</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col l6 offset-l3">
				<div class="center-align">
				<img src="img/travellogo.jpg" style="height:100px;margin-top:20px;" alt="Travel Logo"
						srcset="img/travellogo.jpg">
						<blockquote>Want to change the password</blockquote>
					<blockquote>
						<div>
							<?php echo Message(); ?>
							<?php echo SuccessMessage(); ?>
						</div>
					</blockquote>

				</div>
				<div class="card">
					<div class="card-tabs">
						<ul class="tabs tabs-fixed-width">
							<li class="tab"><a class="active" href="#login">For Login</a>
							</li>
						</ul>
					</div>
					<div class="card-content grey lighten-4">
						<div id="login">
							<form action="profile.php" method="post">
								<div class="row">
									<div class="input-field">
										<input id="login_password" type="password" name="Password" class="validate">
										<label class="active" for="login_password">Password</label>
									</div>
									<div class="row">
									<div class="input-field">
										<input id="login_password" type="password" name="ConfirmPassword" class="validate">
										<label class="active" for="login_password">Confirm Password</label>
									</div>
									
									

								</div>

								<input type="submit" value="Submit" name="Submit" class="btn">
							</form>
						</div>
						</div>


						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/login.js"></script>


</body>

</html>