<?php require_once("Include/Session.php"); ?>
<?php require_once("Include/Styles.css"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php
if(isset($_GET['token'])){
    $TokenFromURL=($_GET['token']);
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
	$Query="UPDATE admin SET password='$Hashed_Password' WHERE token='$TokenFromURL'";
$Execute=mysqli_query($connectingDB,$Query);
if($Execute){
	    $_SESSION["SuccessMessage"]="Password Changed Successfully";
		Redirect_To("Login.php");
}else{
		$_SESSION["message"]="Something Went Wrong Try Again!";
	        Redirect_To("Login.php");
}	
}

	
}
}
?>
<?php ?>
<!DOCTYPE>
<html>
<head>
		<title>hotelbookings-flightbookings-holidayspackages</title>
</head>
	<body>
<div>		
<?php echo Message(); ?>
<?php echo SuccessMessage(); ?></div>
<div id="centerpage">
	<form action="Reset_Password.php?token=<?php echo $TokenFromURL; ?>" method="post">
	<fieldset>

<span class="FieldInfo">New Password:</span><br><input type="password" Name="Password" value=""><br>
<span class="FieldInfo">Confirm Password:</span><br><input type="password" Name="ConfirmPassword" value="">
<br><input type="Submit" Name="Submit" value="Submit"><br>
		
		
	</fieldset>	
			
		
	</form>
	</div>
	    
	</body>
</html>
