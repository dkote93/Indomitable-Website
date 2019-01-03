<?php
	session_start();
	unset($_SESSION['cart_array']);
	unset($_SESSION['order_total']);
	header("Location: xcart.php"); // Redirecting To Home Page
?>