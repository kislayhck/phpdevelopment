<?php
session_start();
function Message(){
    if(isset($_SESSION["message"])){
        $Output="<div class=\"message\">";
        $Output .= htmlentities($_SESSION["message"]);
        $Output .="</div>";
        $_SESSION["message"]=null;
        return $Output;
        
        
    }
}
function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
        $Output="<div class=\"SuccessMessage\">";
        $Output .= htmlentities($_SESSION["SuccessMessage"]);
        $Output .="</div>";
        $_SESSION["SuccessMessage"]=null;
        return $Output;
        
        
    }
}
?>
<!-- 
$Query="INSERT INTO admin(username,email,password)
	VALUES('$Username','$Email','$Hashed_Password')";

    <img src="img/travellogo.jpg" style="height:100px;margin-top:20px;" alt="Travel Logo"
						srcset="img/travellogo.jpg">
					<blockquote>Welcome To Travel Agency Admin-Page</blockquote> -->