<?php
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$connection = mysql_connect("localhost", "root", "");
	// Selecting Database
	$db = mysql_select_db("Indomitable_Database", $connection);
	session_start();// Starting Session
	// Storing Session
	$user_check=$_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	if($user_check >= 1000)
	{
		$ses_sql=mysql_query("SELECT CustomerID FROM Customer_Table WHERE CustomerID='$user_check'", $connection);
		$row = mysql_fetch_assoc($ses_sql);
		$login_session =$row['CustomerID'];
	}
	if(!isset($login_session)){
		mysql_close($connection); // Closing Connection
		//header('Location: Xhome.php'); // Redirecting To Home Page
	}
?>