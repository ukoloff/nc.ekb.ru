<H1>�������� ������</H1>
<?
global $CFG;
$g=trim($_REQUEST['g']);
if(!$g):
 echo "��� �� �������!";
 return;
endif;
echo "����������� ��� ������: <B>", htmlspecialchars($g), "</B><P />";

$CFG->params->g=$g;

if($gdn=group2dn($g)):
 $ufn=new dn($gdn);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
 echo '������ ���: <A hRef="../group/', hRef(), '">', htmlspecialchars($ufn), '</A>';
 echo "<P />����� ������ �������, �������� ��� <B>�����</B> ������������";
 return;
endif;

echo "������ �� �������";
LoadLib('guess');

if(!guessList($g, 'g'))
  echo '... � �� ������� ������ �����, ������������ � "', htmlspecialchars($g), '"... :-(';
?>
