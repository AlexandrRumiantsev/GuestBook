<?
//Регистрация
global $LoginReg;
$LoginReg = $_POST['signup'];
$PasswordReg = $_POST['pass'];
$EmailReg = $_POST['email'];

$link = mysqli_connect("localhost", "root", "", "GuestBook");
$q = "INSERT INTO RegUsers (Log,Pass,mail) VALUES ('$LoginReg','$PasswordReg','$EmailReg')";
mysqli_multi_query($link, $q);
?>