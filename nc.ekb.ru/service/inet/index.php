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

$CFG->Z=Array(101=>'Энфорта', 102=>'Билайн', 103=>'УТК');

if('POST'==$_SERVER['REQUEST_METHOD']):
 LoadLib('set');
endif;

uxmHeader('Провайдер Интернет');
?>
<H1>Провайдер Интернет</H1>
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
<Input Type='Submit' Value=' Установить! ' />
</Form>
</Center>
<Small>
&raquo;
Здесь устанавливается канал по умолчанию для доступа в Интернет изнутри
<BR />&raquo;
Проверка на работоспособность канала не производится
<BR />&raquo;
Доступ извне возможен по любому [работоспособному] каналу
<BR />&raquo;
Попытки переключения записываются в журнал
</body></html>

