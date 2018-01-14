<?
//Регистрация
global $LoginReg;
$LoginReg = $_POST['Log'];
$PasswordReg = $_POST['pass'];
$EmailReg = $_POST['email'];

$LoginReg = mysqli_real_escape_string($link,$LoginReg);
$PasswordReg = mysqli_real_escape_string($link,$PasswordReg);
$EmailReg = mysqli_real_escape_string($link,$EmailReg);

$link = mysqli_connect("localhost", "root", "", "GuestBook");
$q = "INSERT INTO RegUsers (Log,Pass,mail,status) VALUES ('$LoginReg','$PasswordReg','$EmailReg','user')";
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
echo "<script type='text/javascript'>
    alert('Регистрация прошла успешно! На $EmailReg было отправлено письмо с вашими учётными данными.');
window.location.href = 'index.php';
</script>";
exit;
?>
