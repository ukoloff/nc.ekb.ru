<?
global $CFG;
LoadLib('/tabs');

if(!($CFG->emptyDB=0==filesize($CFG->sqlFile))):
 $n=trim($_REQUEST['n']);
 if($n!=(int)$n) $n='';
endif;

if(strlen($n)):
 $q=sqlite3_query($CFG->db, "Select * From Tests Where No=".(int)$n);
 if(!sqlite3_fetch_array($q)) $n='';
 sqlite3_query_close($q);
endif;

$CFG->params->n=$n;

if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'Создать');
else:
 $CFG->tabs['list']='Состав';
 if('tree'==$CFG->params->x) $CFG->tabs['tree']='Дерево';
 if($n):
  $CFG->tabs['data']='Настройки';
  $CFG->tabs['move']='Перенести';
  if('delete'==$CFG->params->x)
    $CFG->tabs['delete']='Удалить?';
  $q=sqlite3_query($CFG->db, "Select Count(*) From Tests Where ParentNo".($CFG->params->n? "=".$CFG->params->n : " Is Null"));
  $r=sqlite3_fetch($q);
  sqlite3_query_close($q);
  if(!$r[0]):
   $CFG->defaults->x='data';
  endif;
 else:
  $CFG->tabs['file']='Файл';
  if($CFG->emptyDB) $CFG->defaults->x='file';
  $Title=Array('copy'=>'Копировать', 'unlink'=>'Удалить', 'rename'=>'Переименовать',
    'schema'=>'Скопировать схему', 'init'=>'Создать таблицы',
    'zip'=>'Схему к отправке', 'zipped'=>'Исполнено');
  $Title=$Title[$CFG->params->x];
  if($Title) $CFG->tabs[$CFG->params->x]=$Title;
 endif;
endif;

tabsBeforeBody();

uxmHeader($n? 'Сервис' : "Файл: ".$CFG->params->f);

echo "<H1>", htmlspecialchars($CFG->title), "</H1>\n";

tabsHeader();
echo '<Div Class="path"><A hRef="./">.</A>/<A hRef="./', 
    htmlspecialchars(hRef('x', '', 'n')), '">', 
    htmlspecialchars($CFG->params->f), '</A>';

$Parents=array();
for($nn=$CFG->params->n; $nn; ):
 $q=sqlite3_query($CFG->db, <<<SQL
Select ParentNo,
    (Select Value From Attrs, AttrVals
        Where Attrs.id='name' And Attrs.No=AttrVals.AttrNo And AttrVals.TestNo=Tests.No) As Name
From Tests
Where No=$nn
SQL
 );
 $r=sqlite3_fetch_array($q);
 sqlite3_query_close($q);
 unset($X);
 $X->No=$nn;
 $X->Name=$r['Name'];
 $nn=$r['ParentNo'];
 array_unshift($Parents, $X);
endfor;
foreach($Parents as $X):
 echo '/<A hRef="./', hRef('n', $X->No, 'x', ''), '">', strlen($X->Name)? htmlspecialchars($X->Name) : '?', "</A>";
endforeach;

echo "</Div>";
tabsContent();
tabsFooter();

?>
