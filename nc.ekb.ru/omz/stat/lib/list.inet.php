<Script Src='stat.js'></Script>
<?
LoadLib('/sort');
LoadLib('/ADobj');
$CFG->defaults->oClasses='u';
$CFG->defaults->sort='on';

$CFG->sort['b']=Array('name'=>'Мб', 'field'=>'b', 'rev'=>1, 'title'=>'Трафик Интернет за месяц');
$CFG->sort['f']=Array('name'=>'Бесплатно', 'field'=>'freeMb', 'title'=>'Бесплатный порог, Мб');
$CFG->sort['q']=Array('name'=>'Квота', 'field'=>'limitMb', 'title'=>'Порог отключения, Мб');
$CFG->sort['r']=Array('name'=>'%', 'field'=>'rate', 'title'=>'Процент расхода месячной квоты');
$CFG->sort['z']=Array('name'=>'Платно', 'field'=>'payedMb', 'title'=>'Платный трафик (превышение порога), Мб');
$CFG->sort['x']=Array('name'=>'Код', 'field'=>'depNo', 'title'=>'Код отдела/подразделения');
$CFG->sort['o']['name']='Отдел';
$CFG->sort['n']['name']='Пользователь';

if(!$CFG->odn) $extraUsers=Array('<'=>'Экском;Входящий трафик', '<UTK'=>'УТК;Входящий трафик', '<GT'=>'Golden Telecom;Входящий трафик');

$q=mysql_query("Select uTotals.u, b, limitMb, freeMb From uTotals Left Join limits Using(u) Where `When`='{$CFG->params->m}'");

unset($Items);
while($r=mysql_fetch_object($q)):
 if($XU=$extraUsers[$r->u]):
  list($xName, $xDept)=explode(';', $XU);
  $x=null;
  $x->isA='u';
  $x->id=$r->u;
  $x->name=$xName;
  $x->ou=$xDept;
  $x->b=$r->b; 
  $extraObj[]=$x;
  continue;
 endif;
 $x=user2obj($r->u);
 if(!$x) continue;
 unset($payed);
 if(is_numeric($x->freeMb=$r->freeMb)):
   $payed=$r->b-$r->freeMb*1024*1024;
   if($payed<=0)unset($payed);
  endif;
 if($x->limitMb=$r->limitMb)
  $x->rate=round($r->b/$r->limitMb/1024/1024*100);
 do{
  $x->b+=$r->b;
  $x->payed+=$payed;
  if($x->Added) continue;
  $x->Added=1;
  $Items[]=&$x;
 }while($x=&obj2parent($x));
endwhile;

unset($CFG->depHash);

function findDepNo($ufn)
{
 global $CFG;
 $ou=$ufn->str();
 if(!$ou or '/'==$ou) return '';
 if(isset($CFG->depHash[$ou]))
  return $CFG->depHash[$ou];
 $dn=$ufn->dn();
 $dn=getEntry($dn->str(), 'l');
 if(!($dn=utf2str($dn['l'][0]))):
  $ufn->Cut();
  $dn=findDepNo($ufn);
 endif;
 $CFG->depHash[$ou]=$dn;
 return $dn;
}

# Проставим код подразделения
for($ii=count($Items)-1; $ii>=0; $ii--):
 $x=&$Items[$ii];
 $xdn=new dn($x->dn);
 if('u'==$x->isA) $xdn->Cut();
 $x->depNo=findDepNo($xdn->ufn());
endfor;

unset($CFG->depHash);

sortArray($Items);

if($extraObj):
 sortArray($extraObj);
 foreach($extraObj as $xx) $Items[]=$xx;
endif;

echo "<Div id='Data'>";
sortedHeader('noxbfqz');
if($Items)
foreach($Items as $xz):
 echoStatObject($xz);
 echo "<TD>", $xz->depNo, "<BR /></TD>\n";
 echo '<TD>', n2M($xz->b);
 echo '</TD><TD>', $xz->freeMb ? $xz->freeMb : "<BR />";
 echo '</TD><TD>', $xz->limitMb ? $xz->limitMb : "<BR />";
// echo "</TD><TD>", $xz->rate;
 echo "</TD><TD>", n2M0($xz->payed), "<BR /></TD></TR>\n";
endforeach;
sortedFooter();
?>
<Div Align='Left'>&raquo;<A hRef='#' onClick='HideLinks(); return false;'>Скрыть</A> все ссылки<BR />
&raquo;Суммарные значения "Итого" и "Входящий трафик" и не должны совпадать
</Div>
</Div>

<H3>Все данные</H3>

<?
LoadLib('summary');
$X=sqlGet("Select min(`When`) Min, max(`When`) Max From uTotals");
$i=new monthIterator($X->Min, $X->Max); 
while($i->Advance())
 if($m=$i->m())
   echo '<Center><A Class="X" hRef="./', hRef('m', $m), "\">&raquo;</A></Center>";
 else
   echo "<BR />";
?>
