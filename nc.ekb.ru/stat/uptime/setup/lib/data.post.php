<?
global $CFG;

$CFG->dataError=false;

function x_sqlite3_exec($h, $S)
{
 echo "<LI>", htmlspecialchars($S), "<BR />\n";
 return true;
}

foreach($_POST as $k=>$v):
 if(!preg_match('/^v(\\d+)$/', $k, $match)) continue;
 $n=$match[1];
 $q=sqlite3_query($CFG->db, "Select Name From Attrs, AttrVals Where Attrs.No=AttrNo And AttrVals.No=$n");
 $r=sqlite3_fetch($q);
 sqlite3_query_close($q);
 $v=trim($v);
 $CFG->oldAttrs[]=Array('No'=>$match[1], 'Value'=>$v, 'Name'=>$r[0]);
 if(strlen($v) and 'new'==$CFG->params->x):
  $varName='v'.$match[1];
  $CFG->Errors->$varName='У вновь создаваемого сервиса нет старых атрибутов';
  $CFG->dataError=true;
 endif;
endforeach;

$m=0;
foreach($_POST['a'] as $a):
 $CFG->newAttrs[$m++]['No']=$a;
endforeach;

$m=0;
foreach($_POST['v'] as $v):
 $v=trim($v);
 $CFG->newAttrs[$m]['Value']=$v;
 if(strlen($v) and !strlen($CFG->newAttrs[$m]['No'])):
  $CFG->newAttrs[$m]['Error']=true;
  $CFG->dataError=true;
 endif;
 $m++;
endforeach;

if(!$CFG->dataError):
 if(sqlite3_exec($CFG->db, "Begin Transaction") and DoIt() and sqlite3_exec($CFG->db, 'Commit Transaction')):
  Header('Location: ./'.hRef('n', 'new'==$CFG->params->x ? $n=$CFG->newN : $CFG->params->n, 'x', 'data'));
 else:
  $CFG->Error=sqlite3_error($CFG->db);
  sqlite3_exec($CFG->db, "Rollback Transaction");
 endif;
endif;


function sqlite3_escape($S)
{
 if(isset($S)) return "'".strtr($S, array("'"=>"''"))."'";
 return 'NULL';
}

function DoIt()
{
 global $CFG;
 $n=$CFG->params->n;

 if('new'==$CFG->params->x):	// Создаём новый сервис
  if(!strlen($n)) $n='NULL';
  if(!sqlite3_exec($CFG->db, "Insert Into Tests(ParentNo) Values($n)")) return;
  $CFG->newN=$n=sqlite3_last_insert_rowid($CFG->db);
 else:				// Обновляем старые атрибуты
  foreach($CFG->oldAttrs as $v):
   if(strlen($v['Value']))	// Обновляем значение
   {
    if(!sqlite3_exec($CFG->db, "Update AttrVals Set Value=".sqlite3_escape($v['Value']).
	" Where No=".$v['No']." And TestNo=".$n." And Value<>".sqlite3_escape($v['Value']))) return;
   }else{			// Удаляем атрибут
    if(!sqlite3_exec($CFG->db, "Delete From AttrVals Where No=".$v['No']." And TestNo=".$n)) return;
   }
  endforeach;
 endif;

 foreach($CFG->newAttrs as $v):	// Добавляем новые атрибуты
  if(!strlen($v['Value'])) continue;
  if(!sqlite3_exec($CFG->db, "Insert Into AttrVals(AttrNo, TestNo, Value) Values(".
	(int)$v['No'].", ".$n.", ".sqlite3_escape($v['Value']).")")) return;
 endforeach;

 return true;
}

?>
