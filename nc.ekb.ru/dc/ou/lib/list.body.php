<?
LoadLib('/sort');
LoadLib('/ditobj');

$q=ldap_list($CFG->h, $CFG->odn->str(), objectClassFilter(), Array(''));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);

unset($Items);

for($i=$e['count']-1; $i>=0; $i--):
 $x=getObject($e[$i]['dn']);
 if($x) $Items[]=$x;
endfor;
sortArray($Items);
if($Items):
 sortedHeader('tnfid');
 foreach($Items as $x):
  echo "<TR><TD>";
  echoObject($x, 'tnfid');
  echo "</TD></TR>\n";
 endforeach;
 sortedFooter();
else:
 echo "<P>&raquo;<A hRef='./", hRef('x', 'delete'), "'>Удалить</A> подразделение</P>\n";
endif;
?>
<BR />
&raquo;Создать:
нового <A hRef='../user/<?= hRef('x', 'new') ?>'>пользователя</A>;
новую <A hRef='../group/<?= hRef('x', 'new') ?>'>группу</A>;
новое <A hRef='./<?= hRef('x', 'new') ?>'>подразделение</A>