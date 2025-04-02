<Script> <!--
function Check()
{
 q=document.forms[0].q;
 if(q.value) return true;
 q.focus();
 return false;
}
//--></Script>
<Form Action='./' Method='GET' onSubmit='return Check()'>
<Table><TR vAlign='Bottom'><TD NoWrap>
<?
$CFG->scopes=Array('d'=>'Весь домен', 't'=>'Всё подразделение', 'o'=>'Только подразделение', 'c'=>'Компьютеры');
$CFG->defaults->in='t';

$CFG->entry->in=trim($_REQUEST['in']);
if(!$CFG->scopes[$CFG->entry->in])$CFG->entry->in=$CFG->defaults->in;
$CFG->entry->q=trim($_REQUEST['q']);

LoadLib('/forms');
LoadLib('/sort');
Input('q', 'Текст');BR();
echo "</TD><TD NoWrap>";
Select('in', $CFG->scopes, 'Где');
echo "</TD><TD><Input Type=Submit Value='Искать' />";
unset($CFG->params->in);
unset($CFG->params->q);
hiddenInputs();
$CFG->params->in=$CFG->entry->in;
$CFG->params->q=$CFG->entry->q;
?>
</TD></TR></Table>
</Form>
<?
if(!$CFG->params->q) return;
LoadLib('/ditobj');
$func=ldap_search;
$classFilter=objectClassFilter();
switch($CFG->params->in)
{
 case 'c':
  $classFilter='(objectClass=computer)';
 case 'd': 
  $Base=$CFG->Base;
  break;
 case 'o':
  $func=ldap_list;
 default:
  $Base=$CFG->odn->str();
}
$q=$func($CFG->h, $Base, $ff="(&$classFilter(anr=".str2ldap($CFG->params->q)."*))", Array('objectClass'));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);
for($i=$e['count']-1; $i>=0; $i--)
 if($x=getObject($e[$i]['dn'])) $Items[]=$x;

sortArray($Items);

if($Items):
 sortedHeader('tnfoid');

 unset($CFG->params->x);
 unset($CFG->params->q);
 unset($CFG->params->in);

 foreach($Items as $x):
  echo "<TR><TD>";
  echoObject($x, 'tnfoid');
  echo "</TD></TR>\n";
 endforeach;
 sortedFooter();
endif;
?>
