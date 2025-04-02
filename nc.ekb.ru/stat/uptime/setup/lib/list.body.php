<?
global $CFG;

LoadLib('/sort');
$CFG->sort=Array(
    'n'=>Array('field'=>'Name', 'name'=>'Хост'),
    'h'=>Array('field'=>'Host', 'name'=>'Адрес'),
);
$CFG->defaults->sort='nh';

$q=sqlite3_query($CFG->db, <<<SQL
Select
    No,
    (Select Value From Attrs, AttrVals
	Where Attrs.id='name' And Attrs.No=AttrVals.AttrNo And AttrVals.TestNo=Tests.No) As Name,
    (Select Value From Attrs, AttrVals
	Where Attrs.id='host' And Attrs.No=AttrVals.AttrNo And AttrVals.TestNo=Tests.No) As Host
From Tests
Where ParentNo
SQL
.($CFG->params->n? '='.$CFG->params->n : ' Is Null'));

$Children=Array();

while($r=sqlite3_fetch_array($q)):
 unset($X);
 foreach($r as $k=>$v):
    $X->$k=$v;
 endforeach;
 $Children[]=$X;
endwhile;

if(count($Children)):
 sortArray($Children);
 sortedHeader('nh');
 foreach($Children as $r):
  echo '<TR><TD><A hRef="./', htmlspecialchars(hRef('n', $r->No)), '">', strlen($r->Name)? htmlspecialchars($r->Name) : '?', 
    '</A><BR /></TD><TD>', htmlspecialchars($r->Host), "<BR /></TD></TR>\n";
 endforeach;
 sortedFooter();
 echo "&raquo; Просмотреть в виде <A hRef='./", htmlspecialchars(hRef('x', 'tree')), "'>дерева</A><BR />\n";
else:
 echo "&raquo; Потомков нет";
 if(strlen($CFG->params->n)) echo "; <A hRef='./", hRef('x', 'delete'), "'>Удалить сервис</A>";
 echo "<BR />\n";
endif;

?>
&raquo; <A hRef='.\<?=hRef('x', 'new') ?>'>Создать потомка</A>
