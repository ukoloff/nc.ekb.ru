<?
LoadLib('/sort');
LoadLib('/ditobj');
$CFG->defaults->oClasses='g';
$CFG->sort['l']=Array('field'=>'Level', 'name'=>'Уровень');
$CFG->defaults->sort='ln';

$dn=$CFG->gdn;
unset($dns); unset($xdns); unset($Items);
$Level=1;
while(true):
 $q=ldap_search($CFG->h, $CFG->Base, "(&(objectClass=Group)(memberOf=".AddCSlashes($dn, "(*)\\")."))", Array(''));
 if(!$q) continue;
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
 for($i=$e['count']-1; $i>=0; $i--):
  $gdn=$e[$i]['dn'];
  if($dns[$gdn] or $xdns[$gdn]) continue;
  $x=getObject($gdn);
  if(!$x) continue;
  $x->Level=$Level;
  $Items[]=$x;
  unset($x);
  $dns[$gdn]=$Level;
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
&raquo;Вернуться к <A hRef='./<?=hRef('x', 'list') ?>'>простому составу</A>
