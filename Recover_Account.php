<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php
if(isset($_POST["Submit"])){

$Email=mysqli_real_escape_string($connectingDB,($_POST["Email"]));

if(empty($Email)){
	$_SESSION["message"]="Email Required";
	Redirect_To("Recover_Account.php");
}elseif(!CheckEmailEkistsOrNot($Email)){
		$_SESSION["message"]="Email not Found";
	Redirect_To("Recover_Account.php");	
}
else{
	global $connectingDB;
	$Query="SELECT * FROM admin WHERE email='$Email'";
	$Execute=mysqli_query($connectingDB,$Query);
	if($admin=mysqli_fetch_array($Execute)){
                $_SESSION["SuccessMessage"]="Email Exists now you can reset your Password";
		Redirect_To("profile.php");
                    } else {
                $_SESSION["message"]="Something Went Wrong Try Again";
		Redirect_To("login.php");
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
	<title></title>
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
						<blockquote>Enter your existing email id</blockquote>
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
							<form action="Recover_Account.php" method="post">
								<div class="row">
									<div class="input-field">
										<input type="email" id="login_email" name="Email">
										<label class="active" for="login_email">Email</label>
									</div>
								</div>

								<input type="submit" value="Submit" name="Submit" class="btn">
							</form>
						</div>


	</body>
</html>
