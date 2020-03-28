<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php
if(isset($_POST["signup_submit"])){
	$Username=mysqli_real_escape_string($connectingDB,($_POST["Username"]));
	$Email=mysqli_real_escape_string($connectingDB,($_POST["Email"]));
	$Password=mysqli_real_escape_string($connectingDB,($_POST["Password"]));
	$ConfirmPassword=mysqli_real_escape_string($connectingDB,($_POST["ConfirmPassword"]));

if(empty($Username)&&empty($Email)&&empty($Password)&&empty($ConfirmPassword)){
	$_SESSION["message"]="All Fields must be filled out";
	Redirect_To("login.php");
}elseif($Password!==$ConfirmPassword){
	$_SESSION["message"]="Both Password Values must be Same";
	Redirect_To("login.php");
	
}elseif(strlen($Password)<4){
	$_SESSION["message"]="Password Should Include at least 4 values";
	Redirect_To("login.php");
	
}elseif(CheckEmailEkistsOrNot($Email)){
		$_SESSION["message"]="Email is Already in Use";
	Redirect_To("login.php");	
}else{
	global $connectingDB;
	$Hashed_Password=Password_Encryption($Password);
	$Query="INSERT INTO admin(username,email,password)
	VALUES('$Username','$Email','$Hashed_Password')";
	$Execute=mysqli_query($connectingDB,$Query);
	if($Execute){
	    Redirect_To("login.php");
                }
}	
}	
?>
<?php ?>
<?php
if(isset($_POST["login_submit"])){
$Email=mysqli_real_escape_string($connectingDB,($_POST["Email"]));
$Password=mysqli_real_escape_string($connectingDB,($_POST["Password"]));
if(empty($Email)||empty($Password)){
	$_SESSION["message"]="All Fields must be filled out";
	Redirect_To("login.php");
}else{
	if(ConfirmingAccountActiveStatus($Email)){
	$Found_Account=Login_Attempt($Email,$Password);
	if($Found_Account){
		$_SESSION["User_Id"]=$Found_Account['id'];
		$_SESSION["User_Name"]=$Found_Account['username'];
		$_SESSION["User_Email"]=$Found_Account['email'];
		if(isset($_POST["Remember"])){
			$ExpireTime=time()+86400;
			setcookie("SettingEmail",$Email,$ExpireTime);
			setcookie("SettingName",$Username,$ExpireTime);
		}
			Redirect_To("Dashboard.php");
		
	}else{
		$_SESSION["message"]="Invalid Email / Password";
		Redirect_To("login.php");
	}
	}
	
}
}
?>
<?php ?>

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
						<blockquote>Welcome To Travel Agency Admin-Page</blockquote>
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
							<li class="tab"><a class="active" href="#login">Login</a>
							</li>
							<li class="tab"><a href="#signup">Signup</a>
							</li>
						</ul>
					</div>
					<div class="card-content grey lighten-4">
						<div id="login">
							<form action="login.php" method="post">
								<div class="row">
									<div class="input-field">
										<input type="email" id="login_email" name="Email">
										<label class="active" for="login_email">Email</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field">
										<input id="login_password" type="password" name="Password" class="validate">
										<label class="active" for="login_password">Password</label>
									</div>
									<p>
										<label>
											<input type="checkbox" Name="Remember" />
											<span>&nbsp;Remember me</span>
										</label>
										<a href="Recover_Account.php"><span
												class="FieldInfo">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Forgot
												Password</span></a>
									</p>

								</div>

								<input type="submit" value="Submit" name="login_submit" class="btn">
							</form>
						</div>
						<div id="signup">
							<form action="login.php" method="post">
								<div class="row">
									<div class="input-field">
										<input type="text" id="signup_name" name="Username" class="validate">
										<label class="active" for="signup_name">Full Name</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field">
										<input type="email" id="signup_email" name="Email" class="validate">
										<label class="active" for="signup_email">Email</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field">
										<input id="signup_password" type="password" name="Password" class="validate">
										<label class="active" for="signup_password">Password</label>
									</div>
								</div>

								<div class="row">
									<div class="input-field">
										<input id="signup_password" type="password" name="ConfirmPassword"
											class="validate">
										<label class="active" for="signup_password">Confirm Password</label>
									</div>
								</div>
								<input type="submit" value="Submit" name="signup_submit" class="btn">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/login.js"></script>


</body>

</html>