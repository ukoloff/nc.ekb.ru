<?
LoadLib('/ldapmod');
//LoadLib('/nw');

if($_POST['p1']!=$_POST['p2']): $CFG->Error='Пароли не совпадают';
elseif(strlen($_POST['p1'])<=3): $CFG->Error='Пароль слишком короткий';
elseif(!preg_match('/^[\x21-\x7F]+$/', $_POST['p1'])): $CFG->Error='Недопустимые символы в пароле';
elseif(ldapChangePass($CFG->params->u, $_POST['p1'])):
 Header("Location: ./".hRef('x', 'ok'));
// nwChangePass($CFG->params->u, $_POST['p1']);
else:
 $CFG->Error=$CFG->ldapError;
endif;
?>
