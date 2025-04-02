<Form Action='./' Method='POST'>
<?
LoadLib('/sort');
LoadLib('/forms');
LoadLib('/ADobj');
$CFG->defaults->sort='no';
$CFG->defaults->oClasses='ug';

$subGroups=0;
for($i=$CFG->entry->ocount-1; $i>=0; $i--):
 $Name="o$i";
 $x=getObject(id2dn($g=$CFG->entry->$Name));
 if(!$x) continue;
 $x->No=$i;
 $Items[]=$x;
 if($x->isA=='g') $subGroups=1;
endfor;

sortArray($Items);

if($Items):
 sortedHeader('ntoid');
 $N=0;
 foreach($Items as $x):
  $MM=('u'==$x->isA and 'stas'==$CFG->u)?'onMouseMove="userThumb(this, '.jsEscape($x->id).')"':'';
  echo "<TR><TD NoWrap $MM>";
  $nm='xo'.$x->No;
  CheckBox($nm, htmlspecialchars($x->name));
  echo "</TD><TD>";
  echoObject($x, 'toid');
  echo "</TD></TR>";
 endforeach;
 sortedFooter();
 echo "&raquo; Снимите флажки, чтобы удалить соответствующие объекты из этой группы<BR />";
 if($subGroups) echo "&raquo; Вы можете посмотреть <A hRef='./", 
    hRef('x', 'sub'), "'>полный список подгрупп</A> (каскадный)<BR />";
?>
&raquo;
Доступен <a href="./<?= hRef('x', 'bcc') ?>">список почтовых адресов</a> членов группы
<br>
&raquo;
Выгрузить полный состав группы в формате <a href="./<?= hRef('x', 'xls') ?>">XLS</a>
<?
endif;
echo "<P />";
Input('add', "Добавить пользователя/группу [<A hRef='../check/' Target='checkWindow'>проверить имя</A>]");
echo "<P /><Input Type='Submit' Value='Удалить/Добавить' />\n";

$CFG->params->ocount=$CFG->entry->ocount;
for($i=$CFG->entry->ocount-1; $i>=0; $i--):
 $Name="o$i";
 $CFG->params->$Name=$CFG->entry->$Name;
endfor;
hiddenInputs();
?>
</Form>
<HR />
<Small>Обратите внимание: в этом окне отображается содержимое группы, то есть те пользователи и [под]группы, которые являются
её членами</Small>

