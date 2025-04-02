<?
Header('Location: '.hRef('x'));
LoadLib('/ldapmod');
//LoadLib('/nw');

function scramble($S)
{
  return base64_encode(utf8($S));
}

if(!CheckAuth()): $CFG->Error='Вы не прошли авторизацию'; 
elseif($_POST['p1']!=$_POST['p2']): $CFG->Error='Пароли не совпадают';
elseif(strlen($_POST['p1'])<=3): $CFG->Error='Пароль слишком короткий';
elseif(!preg_match('/^[\x21-\x7F]+$/', $_POST['p1'])): $CFG->Error='Недопустимые символы в пароле';
elseif($_POST['p1']==$_SERVER['PHP_AUTH_PW']): $CFG->Error='Нельзя поменять пароль, не меняя его!';
elseif($CFG->legacyAuth):
 mysql_query("Update users Set pass='".
    AddSlashes(crypt($_POST['p1'], rand(10,99)))."' Where u='".
    AddSlashes($CFG->u)."'");
 sqlUpdatePass($CFG->u, $_POST['p1']);
else:
 exec('./lib/changepass'.
    ' --uri='.scramble($CFG->uri).
    ' --dn='.base64_encode(user2dn($CFG->u)).
    ' --oldpass='.scramble($_SERVER['PHP_AUTH_PW']).
    ' --newpass='.scramble($_POST['p1']),
    $out, $ret);
 if($ret) $CFG->Error=join("\n", $out);
endif;

if(!$CFG->Error):
 header("Location: ./".hRef('x', 'ok'));
 onChangePass($CFG->u);
// nwChangePass($CFG->u, $_POST['p1']);
endif;
?>
