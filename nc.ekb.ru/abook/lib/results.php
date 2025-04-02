<?
global $CFG;

LoadLib('/sort');
LoadLib('/ditobj');
LoadLib('/pages');

$CFG->sort['n']['name']='Ф.И.О.';
$CFG->sort['i']['name']='Login';
$CFG->sort['o']['name']='Отдел';
$CFG->sort['d']['name']='Заметки';
$CFG->sort['v']=Array('name'=>'vcf', 'title'=>'Загрузить файл визитки',);

hiddenInputs();
$CFG->params->q=$CFG->entry->q;

$q=new ufn();
$q=$q->dn();

$q=ldap_search($CFG->h, $q->str(), 
    "(&(objectClass=user)(!(objectClass=computer))(anr=".str2ldap($CFG->params->q)."*))",
    Array('objectClass'));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);
for($i=$e['count']-1; $i>=0; $i--)
 if($x=getObject($e[$i]['dn'])) $Items[]=$x;
 
sortArray($Items);
$lineNo=pageStart(count($Items));
PageNavigator();
sortedHeader('tivnod');
$caseParams=$CFG->params;
unset($CFG->params->q);
unset($CFG->params->sort);
$vcfs=0;
if($Items):
 while(true):
  $x=$Items[$lineNo];
  if(!$x) break;
  echo "<TR><TD>";
//  echoObject($Items[$lineNo], 'tinod');
  echoObject($x, 't');
  echo '</TD><TD><A hRef="./', htmlspecialchars(hRef('u', $x->id)), '">',
    htmlspecialchars($x->id), "<BR /></TD><TD Align='Center'>";
  if('U'==$x->t):
    $vcfs++;
    echo "<A hRef='./", htmlspecialchars(hRef('vcf', ' ', 'u', $x->id)),
	"' Title='Загрузить визитку пользователя'>Визитка</A>";
  else:
    echo "<BR />";
  endif;
  echo "</TD><TD>";
echo "<!--"; print_r($x); echo "-->";
  echoObject($x, 'n');
  echo "</TD><TD>", htmlspecialchars($x->ou), "<BR /></TD><TD>";
  echoObject($x, 'd');
  echo "</TD></TR>\n";
  if(isLastLine($lineNo++)) break;
 endwhile;
endif;
$CFG->params=$caseParams;
sortedFooter();
PageNavigator(); 

?>
