<Script Src='stat.js'></Script>
<?
$CFG->sort['a']=Array('name'=>'Извне', 'field'=>'extN', 'title'=>'Количество писем, полученных из внешнего мира');
$CFG->sort['b']=Array('name'=>'Мб', 'field'=>'extB', 'rev'=>1, 'title'=>'Объём писем, полученных из внешнего мира');
$CFG->sort['c']=Array('name'=>'Изнутри', 'field'=>'intN', 'title'=>'Количество писем, полученных из локальной сети');
$CFG->sort['d']=Array('name'=>'Мб', 'field'=>'extB', 'rev'=>1, 'title'=>'Объём писем, полученных из локальной сети');

$CFG->sort['o']['name']='Отдел';
$CFG->sort['n']['name']='Пользователь';

$F=Array('extN', 'extB', 'intN', 'intB');

if(!$CFG->odn) $extraUsers=Array('<@'=>'Вся почта;Входящая почта');

$q=mysql_query("Select u, ".join(', ', $F)." From Mails Where Month='{$CFG->params->m}'");

unset($Items);
while($r=mysql_fetch_object($q)):
 if($XU=$extraUsers[$r->u]):
  list($xName, $xDept)=explode(';', $XU);
  $x=null;
  $x->isA='u';
  $x->id=$r->u;
  $x->name=$xName;
  $x->ou=$xDept;
  foreach($F as $k) $x->$k=$r->$k;
  $extraObj[]=$x;
  continue;
 endif;
 $x=user2obj($r->u);
 if(!$x) continue;
 do{
  foreach($F as $k) $x->$k+=$r->$k;
  if($x->Added) continue;
  $x->Added=1;
  $Items[]=&$x;
 }while($x=&obj2parent($x));
endwhile;

sortArray($Items);
if($extraObj):
 sortArray($extraObj);
 foreach($extraObj as $x) $Items[]=$x;
endif;
echo "<Div id='Data'>";
sortedHeader('noabcd');
foreach($Items as $x):
 echoStatObject($x);
 echo '<TD>', $x->extN;
 echo '<BR /></TD><TD>', n2M($x->extB);
 echo '<BR /></TD><TD>', $x->intN;
 echo '<BR /></TD><TD>', n2M($x->intB);
 echo "<BR /></TD></TR>\n";
endforeach;
sortedFooter();
?>
<Div Align='Left'>&raquo;<A hRef='#' onClick='HideLinks(); return false;'>Скрыть</A> все ссылки<BR />
&raquo;Суммарные значения "Итого" и "Вся почта" и не должны совпадать
</Div>
</Div>

<H3>Все данные</H3>

<?
LoadLib('summary');
$X=sqlGet("Select Min(Month) Min, Max(Month) Max From Mails");
$i=new monthIterator($X->Min, $X->Max); 
while($i->Advance())
 if($m=$i->m())
   echo '<Center><A Class="X" hRef="./', hRef('m', $m), "\">&raquo;</A></Center>";
 else
   echo "<BR />"
?>
