<?
function dcUser()
{
 global $CFG;
 $u=trim($_REQUEST['u']);

 if(!strlen($u)) return "Имя не введено!";
 if(!preg_match('/^[-\da-z_.]+$/i', $u)) return "Недопустимые символы в имени!";
 if(user2dn($u)) return "Такой пользователь уже существует!";
 LoadLib('/socket');
 if(checkUser($u)) return "Имя используется почтовой системой (alias?)!";
 return "Имя <B>можно</B> использовать";
}
?>
