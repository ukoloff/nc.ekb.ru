<?
LoadLib('/sort');
LoadLib('/ditobj');

function guessList($id, $classes='ug')
{
 global $CFG;
 $Cols= (strlen($CFG->defaults->oClasses=$classes)>1)? 'ntfiod' : 'nfiofd';
 $q=ldap_search($CFG->h, $CFG->Base, '(&'.objectClassFilter().'(anr='.str2ldap($id).'*))', array(''));
 if(!$q) return;
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
 for($i=$e['count']-1; $i>=0; $i--):
  $x=getObject($e[$i]['dn']);
  if(!$x) continue;
  $Items[]=$x;
 endfor;
 if(count($Items)<=0) return;
 sortArray($Items);
 $i=0;
 echo ", варианты на замену:";
 sortedHeader($Cols);
 foreach($Items as $x):
  echo "<TR><TD NoWrap><A hRef='#' onClick='Click($i); return false;' Title='Заменить на это имя'>&raquo;</A>";
  $X[$i++]=$x->id;
  echoObject($x, $Cols);
  echo "</TD></TR>\n";
 endforeach;
 sortedFooter();
?>
<Script><!--
function Click(n)
{
 if(!((x=window.opener)&&(x=x.document)&&(x=x.forms)&&(x=x[0])&&(x=x.add))) return;
 switch(n)
 {
<?
  foreach($X as $k=>$v)
   echo "\tcase $k: x.value='", AddSlashes($v), "'; break;\n";
?>
 }
 if(confirm("Имя установлено. Закрыть это окно?")) window.close();
}
//--></Script>
<?
 return true;
}
?>
