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
 echo "&raquo; ������� ������, ����� ������� ��������������� ������� �� ���� ������<BR />";
 if($subGroups) echo "&raquo; �� ������ ���������� <A hRef='./", 
    hRef('x', 'sub'), "'>������ ������ ��������</A> (���������)<BR />";
?>
&raquo;
�������� <a href="./<?= hRef('x', 'bcc') ?>">������ �������� �������</a> ������ ������
<br>
&raquo;
��������� ������ ������ ������ � ������� <a href="./<?= hRef('x', 'xls') ?>">XLS</a>
<?
endif;
echo "<P />";
Input('add', "�������� ������������/������ [<A hRef='../check/' Target='checkWindow'>��������� ���</A>]");
echo "<P /><Input Type='Submit' Value='�������/��������' />\n";

$CFG->params->ocount=$CFG->entry->ocount;
for($i=$CFG->entry->ocount-1; $i>=0; $i--):
 $Name="o$i";
 $CFG->params->$Name=$CFG->entry->$Name;
endfor;
hiddenInputs();
?>
</Form>
<HR />
<Small>�������� ��������: � ���� ���� ������������ ���������� ������, �� ���� �� ������������ � [���]������, ������� ��������
� �������</Small>

