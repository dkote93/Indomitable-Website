<!DOCTYPE html>
<?php
	session_start(); // Starting Session
	if(isset($_SESSION['order_total'])){
		$total_message = "$" . $_SESSION['order_total'];
	} else {
		$total_message = "Empty";
	}
	if(isset($_SESSION['logged_in'])){
		$login_message = $_SESSION['logged_in'];
	} else {
		$login_message = "LOG IN";
	}
	$message=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "");
		// To protect MySQL injection for Security purpose
		//$username = stripslashes($username);
		//$password = stripslashes($password);
		//$username = mysql_real_escape_string($username);
		//$password = mysql_real_escape_string($password);
		// Selecting Database
		$db = mysql_select_db("Indomitable_Database", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("SELECT * FROM Customer_Table WHERE CustomerID = '$username' and Password = '$password'", $connection);
		$rows = mysql_num_rows($query);
		$results = mysql_fetch_assoc($query);
		if ($rows == 1) {
			$_SESSION['login_user'] = $username; // Initializing Session
			$_SESSION['logged_in'] = $results['FirstName'];
			$message = "Welcome " . $results['FirstName'] . "!";
		} else {
			$message = "Username or Password is invalid";
		}
		mysql_close($connection); // Closing Connection
	}
?>
<html>
<title>Indomitable Clothing and Apparel</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"><!--used to meet all browser requirements-->
<link rel="stylesheet" href="indomitable.css"><!--linked CSS-->

<style>
.x1-sidenav a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.x1-wide {font-family: "Montserrat", sans-serif;}
p { background-color: 19170;}
div { background-color: #19170;}
</style>

<body class="x1-content" style="max-width:1200px">

<!-- Sidenav/menu -->
<nav class="x1-sidenav x1-white x1-collapse x1-top" style="z-index:3;width:220px" id="mySidenav">
  <div class="x1-container x1-padding-4">
    <i onclick="x1_close()" class="fa fa-remove x1-hide-large x1-closebtn x1-hover-text-red"></i>
    <h3 class="x1-wide x1-bg"><img src="../indomitabletext.png" alt="" style="width:200px"><!--IMAGE NEEDS ADJUSTED--></h3>
  </div>
  <div class="x1-padding-8 x1-large x1-text-grey" style="font-weight:bold">
	<a href="../Xindomitable.php">Home</a>
    <a href="../Xshirts.php">Shirts</a>
    <a href="../Xhome.php">New Apparel</a>
    <a href="../Xsandals.php">Sandals</a>
    <a href="../Xhats.php">Head Wear</a>
	<a href="../Xsunglasses.php">Sunglasses</a>
  </div><br>
  <div class="x1-login">
  <a href="Xlogin.php"> <?php echo $login_message; ?> </a></div>
  <a href="logout.php">LOG OUT</a></div>
  <a href="#footer" class="x1-padding">Contact</a> 
  <a href="javascript:void(0)" class="x1-padding" onclick="document.getElementById('newsletter').style.display='block'">Newsletter</a> 
  <a href="#footer"  class="x1-padding">Subscribe</a>
  <a href="xcart.php">Cart (<?php echo $total_message; ?>)</a>
</nav>

<!-- Top menu on small screens -->
<header class="x1-container x1-top x1-hide-large x1-black x1-xlarge x1-padding-24">
  <span class="x1-left x1-wide">Indomitable Clothing and Apparel</span>
  <a href="javascript:void(0)" class="x1-right x1-opennav" onclick="x1_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidenav on small screens -->
<div class="x1-overlay x1-hide-large" onclick="x1_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="x1-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="x1-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="x1-container x1-xlarge">
     <img src="" alt="" style=""><!--IMAGE NEEDS ADJUSTED-->
    <p class="x1-right">
      <i class="fa fa-shopping-cart Indomitable-margin-right"></i>
      <i class="fa fa-search"></i>
    </p>
  </header>

  <!-- Image header -->
  <div class="x1-display-container x1-container">
  <h1></h1>
    <img src="" alt="" style="width:100%"><!--no image currently inserted-->

<article>
<form action="" method="post">
  <div class="centered">
    <img src="login1.png" alt="LoginAvatars" class="avatar">
	<!--imagecited, www.blastinbid.com-->
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required><br>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required><br>
        
    <button type="submit" name = "submit">Login</button>
    <input type="checkbox" checked="checked"> Remember me <br>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
<form action="Xsignup.php">
	<input type="submit" value="SIGN UP" />
</form>
<br>
<h1><?php echo $message; ?></h1>
</article
<br><br>

  
  <!-- Subscribe section -->
  <div class="x1-container x1-black x1-padding-32">
    <h1 class="x1-sub">Subscribe</h1>
    <p class="x1-sub">To get special offers and VIP treatment:</p>
    <p><input class="x1-input x1-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
    <button type="button" class="x1-button x1-margin-bottom x1-subscribe">Subscribe</button>
  </div>
  
  <!-- Footer -->
  <footer class="x1-padding-64 x1-subscribe x1-small x1-center" id="footer">
    <div class="x1-row-padding">
      <div class="x1-col s4">
        <h4>Contact</h4>
        <p>Questions?</p>
        <form action="/action_page.php" target="_blank">
          <p><input class="x1-input x1-border" type="text" placeholder="Name" name="Name" required></p>
          <p><input class="x1-input x1-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="x1-input x1-border" type="text" placeholder="Subject" name="Subject" required></p>
          <p><input class="x1-input x1-border" type="text" placeholder="Message" name="Message" required></p>
          <button type="submit" class="x1-button x1-block x1-black">Send</button>
        </form>
      </div>

      <div class="x1-col s4">
        <h4>About</h4>
        <p><a href="Xaboutus.php">About us</a></p>
        <p><a href="Xcareers.php">Careers</a></p>
        <p><a href="Xsupport.php">Support</a></p>
        <p><a href="Xnews.php">News and Events</a></p>
        <p><a href="Xreturns.php">Returns</a></p>
      </div>


      <div class="x1-col s4 x1-justify">
        <h4>Store Information</h4>
		<p>We are located at: 2168 Surf Avenue, Miami, FL</p>
        <p><i class="fa fa-fw fa-map-marker"></i>Indomitable Clothing & Apparel</p>
        <p><i class="fa fa-fw fa-phone"></i> 1-800-444-1111</p>
        <p><i class="fa fa-fw fa-envelope"></i> admin@indomitable.com</p>
        <h4>We accept</h4>
        <p><i class="fa fa-fw fa-cc-amex"></i>Use Paypal for faster shipment & discount</p>
        <p><i class="fa fa-fw fa-credit-card"></i> Credit Card</p>
        <br>
        <i class="fa fa-facebook-official x1-xlarge x1-hover-text-indigo"></i>
        <i class="fa fa-instagram x1-xlarge x1-hover-text-purple"></i>
        <i class="fa fa-twitter x1-xlarge x1-hover-text-light-blue"></i>
        <i class="fa fa-pinterest x1-xlarge x1-hover-text-red"></i>
        <i class="fa fa-flickr x1-xlarge x1-hover-text-blue"></i>
      </div>
    </div>
<footer>
<br>
Copyright &copy;  Condor Consulting Firm CSCI Project<br>
<a href="mailto:smiller221@student.cscc.edu">Please contact me with any questions!</a>
<br>
<a href="https://www.facebook.com/Indomitable-Clothing-Apparel-196976967457398/"><div class="x1-social"><img src="socialmedia/facebook.png" alt="Facebook" style="width:50px;height:50px"></a><a href=""><img src="socialmedia/instagram.png" alt="Instagram"style="width:50px;height:50px"></a><a href=""><img src="socialmedia/youtube.png" alt="Youtube" style="width:50px;height:50px"></a><a href=""><img src="socialmedia/snapchat.png" alt="Snapchat" style="width:50px;height:50px"></a><a href="https://twitter.com/indomitableUNL"><img src="socialmedia/twitter.png" alt="Twitter" style="width:50px;height:50px"></a>
</div>
<br>
</footer>

  

  <!-- End page content -->
</div>

<!-- Newsletter Modal -->
<div id="newsletter" class="x1-modal">
  <div class="x1-modal-content x1-animate-zoom x1-padding-jumbo">
    <div class="x1-container x1-white x1-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove x1-closebtn x1-xlarge x1-hover-text-grey x1-margin"></i>
      <h2 class="x1-wide">NEWSLETTER</h2>
      <p>Join our mailing list to receive updates on new arrivals and special offers.</p>
      <p><input class="x1-input x1-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="x1-button x1-padding-large x1-red x1-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>

<script>
// Accordion 
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("x1-show") == -1) {
        x.className += " x1-show";
    } else {
        x.className = x.className.replace(" x1-show", "");
    }
}

// Click on the " New Apparel" link on page load to open the accordion for demo purposes
document.getElementById("myBtn").click();


// Script to open and close sidenav
function x1_open() {
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function x1_close() {
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>