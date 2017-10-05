<?
//Регистрация
global $LoginReg;
$LoginReg = $_POST['Log'];
$PasswordReg = $_POST['pass'];
$EmailReg = $_POST['email'];

$link = mysqli_connect("localhost", "root", "", "GuestBook");
$q = "INSERT INTO RegUsers (Log,Pass,mail) VALUES ('$LoginReg','$PasswordReg','$EmailReg')";

//отправка письма
//$to ="nobody@example.com";
//$subject ='the subject';
//$message ='hello';
//$headers ='From: webmaster@example.com'."\r\n".'Reply-To: webmaster@example.com'."\r\n".'X-Mailer: PHP/'.phpversion();
//mail($to,$subject,$message,$headers);

mail("nobody@example.com",
    'Успешная регистрация!',
    'Здравствуйте, вы зарегестрировались в гостевой книге. 
     Ваш логин: '.$LoginReg .'
     '
     .'Ваш пароль: ' .$PasswordReg .'
     '
     .'From: Александр Румянцев');
mysqli_multi_query($link, $q);

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';

//header("Location: http://$host$uri/$extra");
//header("echo \"<script>alert('Регистрация прошла успешно')</script>\";");

echo "<script type='text/javascript'>
    alert('Регистрация прошла успешно! На $EmailReg было отправлено письмо с вашими учётными данными.');
window.location.href = 'index.php';
</script>";
exit;
?>
