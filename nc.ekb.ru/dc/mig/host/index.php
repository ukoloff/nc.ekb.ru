<?
setlocale(LC_ALL, "ru_RU.cp1251");
require('../../../lib/uxm.php');

$n=(int)$_REQUEST['n'];

$Fields=Array(
 'Дата и время'=>'utc',
 'Компьютер'=>'host',
 'IP'=>'ip',
 'Версия Windows'=>'winVer',
 'Комната'=>'Room',
 'Здание'=>'Building',
 'Телефон'=>'Phone',
 'Заметки'=>'Notes',
 'Пользователь'=>'u',
);

uxmHeader('Компьютер');
?>
<H1>Компьютер</H1>
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
<H2>Учётные записи</H2>
<Center>
<Table Border CellSpacing='0' CellPadding='0'>
<TR Class='tHeader'>
<TH>Сервер</TH>
<TH>Учётная запись</TH>
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
<Small>&raquo; Примечание: Строка, где сервер '.' содержит имя локального пользователя компьютера
</Small>
</body></html>

