<?
LoadLib('/ADx');

if(!$CFG->Auth)
	$CFG->Error='�� �� ������ �����������';
elseif($_POST['p1']!=$_POST['p2'])
	$CFG->Error='������ �� ���������';
elseif(strlen($_POST['p1'])<=3)
	$CFG->Error='������ ������� ��������';
elseif(!preg_match('/^[\x21-\x7F]+$/', $_POST['p1']))
	$CFG->Error='������������ ������� � ������';
elseif($_POST['p1']==$_SERVER['PHP_AUTH_PW'])
	$CFG->Error='������ �� ���������!';

if($CFG->Error) return;

exec(dirname(__FILE__).'/pass.pl'.
    ' --uri='.scramble($CFG->AD->Srv).
    ' --dn='.base64_encode(user2dn($CFG->u)).
    ' --oldpass='.scramble($_SERVER['PHP_AUTH_PW']).
    ' --newpass='.scramble($_POST['p1']),
    $out, $ret);
if($ret):
 $CFG->Error=join("\n", $out);
 return;
endif;

header("Location: ./".hRef('x', 'ok'));
onChangePass($CFG->u);

function scramble($S)
{
  return base64_encode(utf8($S));
}

?>
