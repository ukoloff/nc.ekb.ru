<?
$ug=trim($_REQUEST['ug']);
if(!$ug):
 echo "��� �� �������!";
 return;
endif;
echo "����������� ��� �������: <B>", htmlspecialchars($ug), "</B><P />";

//$CFG->params->ug=$ug;

if($dn=group2dn($ug)):
 $hRef='group';
 $Name='������';
 $Field='g';
elseif($dn=user2dn($ug)):
 $hRef='user';
 $Name='������������';
 $Field='u';
endif;

if($dn):
 $ufn=new dn($dn);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
 echo "������ ��� $Name: <A hRef=\"../$hRef/", hRef($Field, $ug), '">', htmlspecialchars($ufn), '</A>';
 echo "<P />����� ������ �������, �������� ��� <B>�����</B> ������������";
 return;
endif;

echo "������ �� ������";
LoadLib('guess');

if(!guessList($ug, 'ug'))
  echo '... � �� ������� ������ ��������, ������������ � "', htmlspecialchars($ug), '"... :-(';
?>
