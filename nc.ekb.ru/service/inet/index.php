<?
global $CFG;

header('Location: /omz/service/inet/');

require("../../lib/uxm.php");

AuthorizedOnly();
$i=$CFG->Menu->findItem('/service/inet/');
if(!$i->href):
  Header('Location: /');
  uxmHeader();
  exit;
endif;

$CFG->Z=Array(101=>'�������', 102=>'������', 103=>'���');

if('POST'==$_SERVER['REQUEST_METHOD']):
 LoadLib('set');
endif;

uxmHeader('��������� ��������');
?>
<H1>��������� ��������</H1>
<Center>
<Form Action='./' Method='POST'>
<Table><TR><TD>
<?
exec('/sbin/ip rule list', $Res);
foreach($Res as $k)
  if(preg_match('/^50000:\s+/', $k) and preg_match('/\d+$/', $k, $M))
    $CFG->entry->z=$M[0];
LoadLib('/forms');
foreach($CFG->Z as $k=>$v):
 RadioButton('z', $k, $v);
?>
<P>
<? 
endforeach;
?>
</TD></TR></Table>
<Input Type='Submit' Value=' ����������! ' />
</Form>
</Center>
<Small>
&raquo;
����� ��������������� ����� �� ��������� ��� ������� � �������� �������
<BR />&raquo;
�������� �� ����������������� ������ �� ������������
<BR />&raquo;
������ ����� �������� �� ������ [����������������] ������
<BR />&raquo;
������� ������������ ������������ � ������
</body></html>

