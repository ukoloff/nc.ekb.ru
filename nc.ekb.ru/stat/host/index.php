<?
require('../../lib/uxm.php');

if(!preg_match('/^(\\d+\\.){4}$/', ($CFG->params->ip=trim($_REQUEST['ip'])).".")) $CFG->params->ip='';

$backLinks=inGroupX('#Statistics');

uxmHeader('Компьютер ['.$CFG->params->ip.']');
?>
<H1>Компьютер
<Table Border CellSpacing='0'>
<TR><TH Align='Right'>IP-адрес</TH><TD><?=$CFG->params->ip?></TD></TR>
<TR><TH Align='Right'>Имя компьютера</TH><TD><?= 
 htmlspecialchars(preg_replace('/\\.uxm$/', '', sqlGet("Select host From ip2host Where ip='{$CFG->params->ip}' And Month='{$CFG->params->m}'")))
?><BR /></TD></TR>
</Table>
</H1>
<BR />
<?
if(preg_match('/^192\\.168\\.\\d\\./', $CFG->params->ip))
 $Msg='Этот адрес предоставляется при дозвоне и входе в сеть по модему';
elseif(preg_match('/^127\\./', $CFG->params->ip))
 $Msg='На этот адрес регистрируется чтение почты через <A hRef="/mail/">веб-интерфейс</A>,
а также вход на сайт Сетевого центра при нестандартной настройке прокси-сервера';

if($Msg):
 echo $Msg, ". Статистика по нему не отображается.\n</body></html>";
 exit;
endif;

LoadLib('/ditobj');
LoadLib('/sort');
//$CFG->sort['u']=Array('field'=>'u', 'name'=>'Пользователь', 'title'=>'Учётная запись, под которой осуществлялся доступ');
$CFG->sort['b']=Array('field'=>'b', 'name'=>'Мб', 'rev'=>1, 'title'=>'Интернет трафик, Мегабайт');
$CFG->sort['m']=Array('field'=>'mail', 'name'=>'Почта', 'title'=>'Осуществлялось ли чтение почты');
$CFG->sort['w']=Array('field'=>'www', 'name'=>'WWW', 'title'=>'Осуществлялся ли вход на сайт Сетевого центра');
$CFG->sort['o']['name']='Отдел';
$CFG->sort['n']['name']='Пользователь';
$CFG->defaults->oClasses='u';
$CFG->defaults->sort='b';

$q=mysql_query("Select * From ipUse Where ip='{$CFG->params->ip}' And Month='{$CFG->params->m}'");
while($r=mysql_fetch_object($q)):
 $x=getObject(user2dn($r->u));
 if(!$x) continue;
 $x->b=$r->b;
 $x->mail=$r->mail;
 $x->www=$r->www;
 $Items[]=$x;
endwhile;
sortArray($Items);
sortedHeader('noibmw');
if(is_array($Items))
foreach($Items as $x):
 echo "<TR><TD>", htmlspecialchars($x->name), "</TD><TD>", htmlspecialchars($x->ou), "</TD><TD>";
 if($backLinks) echo '<A hRef="../', hRef('u', $x->id, 'x', 'where'), '">';
 echo htmlspecialchars($x->id);
 if($backLinks) echo "</A>";
 echo "</TD><TD Align='Right'>";
 if($x->b) printf("%.1f", $x->b/1024/1024);
 echo "<BR /></TD><TD Align='Center'>", $x->mail?'+':'-', "</TD><TD Align='Center'>", $x->www?'+':'-', "</TD></TR>\n";
endforeach;
sortedFooter();

echo "<Center><H3>Все данные</H3>";
LoadLib('../summary');
unset($Min); 
$q=mysql_query("Select Month, count(*) N From ipUse Where ip='{$CFG->params->ip}' Group By Month Order By Month");
while($r=mysql_fetch_object($q)):
 $X[$Max=$r->Month]=$r->N;
 if(!$Min)$Min=$Max;
endwhile;

$i=new monthIterator($Min, $Max); 
while($i->Advance())
 if($m=$i->m() and $n=$X[$m])
  echo '<A hRef="./', hRef('m', $m), "\">$n</A>";


?>
</Center>
<Small>
На этой странице показаны все пользователи, работавшие на компьютере [<?=htmlspecialchars($CFG->params->ip)?>]. 
<UL>
<LI>Поле "Мб" означает количество информации, скачанной пользователем с этого компьютера из Интернета.
<LI>В поле "Почта" стоит "+", если пользователь читал почту с этого компьютера.
<LI>В поле "WWW" стоит "+", если пользователь заходил с этого компьютера на сайт сетевого центра (этот сайт)
</UL>
Если Вы указаны в этом списке, но фактически Вы не работали на этом компьютере - значит, скорее, всего владелец
этого компьютера знает Ваш пароль. В этом случае рекомендуем немедленно <A hRef='/pass/'>сменить пароль</A>!
<P>
Узнать настоящего владельца компьютера проще всего по тому факту, что он читает почту с этого компьютера. 
Более точно владельца компьютера может установить системный администратор.
</Small>
</body></html>
