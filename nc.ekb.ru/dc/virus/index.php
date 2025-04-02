<?
require("../../lib/uxm.php");
if(!preg_match('/^(\\d+\\.){4}$/', ($CFG->params->ip=trim($_REQUEST['ip'])).".")) $CFG->params->ip='';

$backLinks=1;

uxmHeader('Рассылка вируса');
?>
<H1>Рассылка вируса
<Table Border CellSpacing='0'>
<TR><TH Align='Right'>IP-адрес</TH><TD><?=$CFG->params->ip?></TD></TR>
<TR><TH Align='Right'>Имя компьютера</TH><TD><?= 
 htmlspecialchars(preg_replace('/\\.uxm$/', '', 
    sqlGet("Select host From ip2host Where ip='{$CFG->params->ip}' And Month=Date_Format(Now(), '%Y%m')")))
?><BR /></TD></TR>
<TR><TH Align='Right'>Вирус</TH><TD><?=htmlspecialchars(trim($_REQUEST['vir']))?>
</TD></TR>
</Table>
</H1>
<?
LoadLib('/ditobj');
LoadLib('/sort');
//$CFG->sort['u']=Array('field'=>'u', 'name'=>'Пользователь', 'title'=>'Учётная запись, под которой осуществлялся доступ');
$CFG->sort['b']=Array('field'=>'b', 'name'=>'Мб', 'rev'=>1, 'title'=>'Интернет трафик, Мегабайт');
$CFG->sort['m']=Array('field'=>'mail', 'name'=>'Почта', 'title'=>'Осуществлялось ли чтение почты');
$CFG->sort['o']['name']='Отдел';
$CFG->sort['n']['name']='Пользователь';
$CFG->defaults->oClasses='u';
$CFG->defaults->sort='b';

$q=mysql_query("Select * From ipUse Where ip='{$CFG->params->ip}' And Month=Date_Format(Now(), '%Y%m')");
while($r=mysql_fetch_object($q)):
 $x=getObject(user2dn($r->u));
 if(!$x) continue;
 $x->b=$r->b;
 $x->mail=$r->mail;
 $Items[]=$x;
endwhile;
sortArray($Items);
sortedHeader('noibm');
if(is_array($Items))
foreach($Items as $x):
 echo "<TR><TD>", htmlspecialchars($x->name), "</TD><TD>", htmlspecialchars($x->ou), "</TD><TD>";
 if($backLinks) echo '<A hRef="../user/', hRef('u', $x->id), '">';
 echo htmlspecialchars($x->id);
 if($backLinks) echo "</A>";
 echo "</TD><TD Align='Right'>";
 if($x->b) printf("%.1f", $x->b/1024/1024);
 echo "<BR /></TD><TD Align='Center'>", $x->mail?'+':'-';
 echo "</TD></TR>\n";
endforeach;
sortedFooter();

?>

</body></html>
