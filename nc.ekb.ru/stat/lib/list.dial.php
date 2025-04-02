<Script Src='stat.js'></Script>
<?
setlocale(LC_ALL, "ru_RU.cp1251");

$CFG->sort['s']=Array('name'=>'Время', 'field'=>'min', 'title'=>'Время онлайн');
$CFG->sort['m']=Array('name'=>'$', 'field'=>'ue', 'rev'=>1, 'title'=>'Плата за время, в рублях и копейках');

$CFG->sort['o']['name']='Отдел';
$CFG->sort['n']['name']='Пользователь';

$q=mysql_query("Select u, sum(ceiling(Seconds/60)) min, sum(ue) ue From Connections 
Where StartTime Like '".substr($CFG->params->m, 0, 4)."-".substr($CFG->params->m, 4, 2)."-%' Group By u");

unset($Items);
$ue=0;
while($r=mysql_fetch_object($q)):
 $x=user2obj($r->u);
 if(!$x) continue;
 if($r->ue>0) $ue=1;
 do{
  $x->min+=$r->min;
  $x->ue+=$r->ue;
  if($x->Added) continue;
  $x->Added=1;
  $Items[]=&$x;
 }while($x=&obj2parent($x));
endwhile;

sortArray($Items);
echo "<Div id='Data'>";
sortedHeader($ue ? 'nosm' : 'nos');
foreach($Items as $x):
 echoStatObject($x);
 echo '<TD>', min2h($x->min);
 if($ue) printf('<BR /></TD><TD>%.2f', $x->ue/100);
 echo "<BR /></TD></TR>\n";
endforeach;
sortedFooter();
?>
<Div Align='Left'>&raquo;<A hRef='#' onClick='HideLinks(); return false;'>Скрыть</A> все ссылки</Div>
</Div>

<H3>Все данные</H3>

<?
LoadLib('summary');
$X=sqlGet("Select min(StartTime) Min, max(StartTime) Max From Connections");
$i=new monthIterator(MonthCvt($X->Min), MonthCvt($X->Max)); 
while($i->Advance())
 if($m=$i->m())
  echo '<Center><A Class="X" hRef="./', hRef('m', $m), "\">&raquo;</A></Center>";

function MonthCvt($x)
{
 list($y, $m)=explode('-', $x);
 return $y.$m;
}
?>
