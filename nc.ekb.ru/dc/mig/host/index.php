<?
setlocale(LC_ALL, "ru_RU.cp1251");
require('../../../lib/uxm.php');

$n=(int)$_REQUEST['n'];

$Fields=Array(
 '���� � �����'=>'utc',
 '���������'=>'host',
 'IP'=>'ip',
 '������ Windows'=>'winVer',
 '�������'=>'Room',
 '������'=>'Building',
 '�������'=>'Phone',
 '�������'=>'Notes',
 '������������'=>'u',
);

uxmHeader('���������');
?>
<H1>���������</H1>
<Table Border CellSpacing='0' Width='100%'>
<?
$X=sqlGet("Select *, UNIX_TIMESTAMP(At) As utc From migHost Where N=$n");
foreach($Fields As $k=>$v):
 echo "<TR><TH Align='Right'>$k</TH>\n<TD>";
 switch($v)
 {
  case 'u':
   echo '<A hRef="/dc/user/', hRef('u', $X->u), '">', htmlspecialchars($X->u), "</A>";
   break;
  case 'utc':
   echo strftime("%c", $X->utc);
   break;
  default:
   echo nl2br(htmlspecialchars(rtrim($X->$v)));
 }
 echo "<BR /></TD></TR>\n";
endforeach;
?>
</Table>
<H2>������� ������</H2>
<Center>
<Table Border CellSpacing='0' CellPadding='0'>
<TR Class='tHeader'>
<TH>������</TH>
<TH>������� ������</TH>
</TR>
<?
$q=mysql_query("Select * From migUser Where hostN=$n");
while($r=mysql_fetch_object($q)):
 echo "<TR><TD Align='Right'>", htmlspecialchars($r->Server), "<BR /></TD>
<TD>", htmlspecialchars($r->u), "<BR /></TD></TR>
";
endwhile;
?>
</Table></Center>
<Small>&raquo; ����������: ������, ��� ������ '.' �������� ��� ���������� ������������ ����������
</Small>
</body></html>

