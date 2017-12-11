<?php  
$email = $_POST['email'];
$town = $_POST['town'];
$pol = $_POST['pol'];
$years = $_POST['years'];
$email = strip_tags($email);
$town = strip_tags($town);
$pol = strip_tags($pol);
$years = strip_tags($years);
$login = strip_tags($login);
	$mysqli = new mysqli ("localhost","root","","GuestBook");
      $mysqli -> query ("SET CHARSET 'utf8'");
	  $login = $_POST['login'];
	 $q = "UPDATE RegUsers 
	       SET
		   mail = '$email', 
		   town = '$town', 
		   pol = '$pol', 
		   years = '$years'
		   WHERE Log='$login'";
     $success = $mysqli -> query ("$q");
    if($success == 1){$mysqli -> close ();
	header('Location: Profile.php');}
	?>