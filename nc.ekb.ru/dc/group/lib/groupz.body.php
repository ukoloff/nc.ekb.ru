<?
LoadLib('/sort');
LoadLib('/ditobj');
$CFG->defaults->oClasses='g';
$CFG->sort['l']=Array('field'=>'Level', 'name'=>'Уровень');
$CFG->defaults->sort='ln';

$dn=$CFG->idn;
unset($dns); unset($xdns);
$Level=1;
while(true):
 $e=getEntry($dn, 'memberOf');
 $e=$e[$e[0]];
 for($i=$e['count']-1; $i>=0; $i--):
  if($dns[$dn=$e[$i]] or $xdns[$dn]) continue;
  $x=getObject($dn);
  if(!$x) continue;
  $x->Level=$Level;
  $Items[]=$x;
  unset($x);
  $dns[$dn]=$Level;
 endfor;
 if(count($dns)<=0) break;
 reset($dns);
 $Level=1+current($dns);
 $dn=key($dns);
 unset($dns[$dn]);
 $xdns[$dn]=1;
endwhile;
unset($xdns); unset($dns);
sortArray($Items);
sortedHeader('lnoid');
foreach($Items as $x):
 echo "<TR><TD Align='Right'>";
 if($x->Level>1) echo $x->Level;
 echo "<BR /></TD><TD>";
 echoObject($x, 'noid');
 echo "</TD></TR>\n";
endforeach;
sortedFooter();
?>
&raquo;Вернуться к <A hRef='./<?=hRef('x', 'groups') ?>'>простому списку групп</A>
