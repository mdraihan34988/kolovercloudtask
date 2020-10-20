<?php
include "includes/dbconnect.php";

if(isset($_GET['Val'])){
	$lv = $_GET['Val'];
	$commentsQuery = "delete from item where Id='$lv'";
	$resultComments = mysqli_query($conn, $commentsQuery);
	
		
	
}


?>
