<H1>�������� ������������/������</H1>
<?
global $CFG;
$ug=trim($_REQUEST['ug']);
if(!$ug):
 echo "��� �� �������!";
 return;
endif;
echo "����������� ��� �������: <B>", htmlspecialchars($ug), "</B><P />";

$CFG->params->ug=$ug;

if($dn=group2dn($ug)):
 $hRef='group';
 $Name='������';
elseif($dn=user2dn($ug)):
 $hRef='user';
 $Name='������������';
endif;

if($dn):
 $ufn=new dn($dn);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
 echo "������ ��� $Name: <A hRef=\"../$hRef/", hRef(), '">', htmlspecialchars($ufn), '</A>';
 echo "<P />����� ������ �������, �������� ��� <B>�����</B> ������������";
 return;
endif;

echo "������ �� ������";
LoadLib('guess');

if(!guessList($ug, 'ug'))
  echo '... � �� ������� ������ ��������, ������������ � "', htmlspecialchars($ug), '"... :-(';
?>
