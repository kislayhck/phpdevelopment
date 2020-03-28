<?php require_once("include/Sessions.php");  ?>
<?php require_once("include/Functions.php");  ?>
<?php require_once("include/DB.php");  ?>
<?php Confirm_Login(); ?>
<?php
    include("header.php");
?>
		<div><?php echo Message();
				   echo SuccessMessage();
		 ?></div>
		 <div class="container-fluid">
		<h1 style="background-color: #262626;color:#fff;">Admin Dashboard</h1>
	</div>
		<br>
		<br>
	<div class="table-responsive">
		<table class="table table table-hover">
			<tr>
				<th>No.</th>
				<th>Post Title</th>
				<th>Date & Time</th>
				<th>Author</th>
				<th>Category</th>
				<th>Banner</th>
				<th>Comments</th>
				<th>Action</th>
			</tr>
<?php

$connectingDB;
$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc";
$Execute=mysqli_query($connectingDB,$ViewQuery);
$SrNo=0;
while ($DataRows=mysqli_fetch_array($Execute)) {
	$Id=$DataRows["id"];
	$DataTime=$DataRows["datetime"];
	$Title=$DataRows["title"];
	$Category=$DataRows["category"];
	$Admin=$DataRows["author"];
	$Image=$DataRows["image"];
	$Post=$DataRows["post"];
	$SrNo++;
	?>

	<tr>
	<td><?php
	if(strlen($Title)>20){$Title=substr($Title,0,20).'..';}
	 echo $SrNo; ?>	
	</td>
	<td><?php echo $Title; ?></td>
	<td><?php 
	if(strlen($DataTime)>11){$DataTime=substr($DataTime,0,11).'..';}
	echo $DataTime; ?></td>
	<td><?php
	if(strlen($Admin)>20){$Admin=substr($Admin,0,6).'..';}
	 echo $Admin; ?></td>
	<td><?php echo $Category; ?></td>
	<td><img src="Upload/<?php echo $Image; ?>" width="170px"; height="50px" ></td>
	<td>Processing</td>
	<td>
	<a href="EditPost.php?Edit=<?php echo $Id; ?>">
		<span class="btn btn-warning">Edit</span></a>
	<a href="DeletePost.php?Delete=<?php echo $Id; ?>">
		<span class="btn btn-danger">Delete</span></a> 


</td>
	</tr>





<?php } ?>	

		</table>



	</div>	
		
	</div><!-- Ending of main area -->
</div>
</div>
<?php
    include("footer.php");
?>
</body>
</html>													