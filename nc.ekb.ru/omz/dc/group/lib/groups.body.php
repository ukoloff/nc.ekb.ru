<Form Action='./' Method='POST'>
<?
LoadLib('/sort');
LoadLib('/forms');
LoadLib('/ADobj');
$CFG->defaults->sort='no';
$CFG->defaults->oClasses='g';

for($i=$CFG->entry->gcount-1; $i>=0; $i--):
 $Name="g$i";
 $x=getObject(group2dn($g=$CFG->entry->$Name));
 if(!$x) continue;
 $x->No=$i;
 $Items[]=$x;
endfor;
sortArray($Items);

if($Items):
 sortedHeader('noid');
 $N=0;
 foreach($Items as $x):
  echo "<TR><TD NoWrap>";
  $nm='xg'.$x->No;
  CheckBox($nm, htmlspecialchars($x->name));
  echo "</TD><TD>";
  echoObject($x, 'oid');
  echo "</TD></TR>";
 endforeach;
 sortedFooter();
 echo "
&raquo;Снимите флажки, чтобы удалить из соответствующих групп<BR />
&raquo;Вы можете посмотреть <A hRef='./", hRef('x', 'groupz'), "'>список всех родительских групп</A> (каскадный)<BR />
";
endif;
echo "<P />";
Input('add', "Добавить в группу [<A hRef='../check/' Target='checkWindow'>проверить имя</A>]");
echo "<P /><Input Type='Submit' Value='Удалить/Добавить' />\n";

$CFG->params->gcount=$CFG->entry->gcount;
for($i=$CFG->entry->gcount-1; $i>=0; $i--):
 $Name="g$i";
 $CFG->params->$Name=$CFG->entry->$Name;
endfor;
hiddenInputs();
?>
</Form>
