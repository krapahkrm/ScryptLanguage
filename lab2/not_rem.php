<?php 
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, count($alphabet)-1);
        $pass[$i] = $alphabet[$n];
    }
    return implode($pass);
}
header('Content-Type: text/html; charset=utf-8');
	if (isset($_POST['zabil_pass']))//тут я обрабатываю нажатие кнопочки на форме
{
    include ("bd.php");
    $zabil_pass = mysql_query("SELECT * FROM user WHERE email='".$_POST['email']."'");    
    $count = mysql_num_rows($zabil_pass);
    if (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
            {
                
            
                    if ($count==1)
                    {

                                $vyvod_zabil_pass = mysql_fetch_assoc($zabil_pass);
                               	$newpass = randomPassword();
                                
                                
                        /* получатели */
                                $to= "".$_POST['email']."";
                                /* тема/subject */
                                $subject = "Забыли пароль?";
                                /* сообщение */
                                $message = 'Ваш новый пароль:'.$newpass;
                                    /* Для отправки HTML-почты вы можете установить шапку Content-type. */
                                
                                $headers = "Content-type: text/plain; charset=windows-1251\r\n";
                                
                                /* дополнительные шапки */
                                $headers .= "From: Administrator\n";
                            
                                
                                /* и теперь отправим из */
                            mail($to, $subject, $message, $headers);

                             mysql_query("UPDATE user SET password='".md5($newpass)."' WHERE email='".$_POST['email']."'");
                            exit("Пароль отправлен. <a href='index.php'>На главную</a>.");
                    }
                    else
                    {
                            exit("Такого e-mail в базе не существует!") ; 
                    }
        }
        else
        {
            exit("Неверный формат e-mail!<br/>") ; 
        }
}
?>
<html>
    <head>
         <meta charset="utf-8">
    <title>Главная страница</title>
    </head>
    <body>
<form action="" method="post" id="form1" name="form1">
  <p>
    Введите Ваш e-mail:
    <input type="text" name="email" id="email">
</p>
  <p>
    <input type="submit" name="zabil_pass" id="zabil_pass" value="Выслать пароль">
</p>
</form>
</body>
</html>