<?
function checkNewUser()
{
 global $CFG;
 $u=trim($_REQUEST['u']);

 if(!strlen($u)) return "Имя не введено!";
 if(!preg_match('/^[-\da-z_.]+$/i', $u)) return "Недопустимые символы в имени!";
 if(id2dn($u)) return "Такой пользователь уже существует!";
 return "Имя <B>можно</B> использовать";
}

?>
