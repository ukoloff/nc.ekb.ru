<?
if('#'==$_POST['i']{0}):	// Delete
 if(preg_match('/\d+/', $_POST['i'], $M))
   @mssql_query('Delete From orders Where ID='.$M[0]);
 header('Location: ./'.hRef('x', 'orders'));
 exit;
endif;

$CFG->params->i=(' '==$_POST['i']?' ':(int)trim($_POST['i']));

$Fld=Array(name=>0, customer=>0, comment=>0, skip=>0);

foreach($Fld as $k=>$v)
  $CFG->entry->$k=trim($_POST[$k]);
$CFG->entry->skip=!!$CFG->entry->skip;

foreach($_POST as $k=>$v)
 if(preg_match('/^c\d+$/', $k))
  $CFG->entry->$k=!!$v;

if(!strlen($CFG->entry->name))
  $CFG->Errors->name='Не задан номер заказа';

if($CFG->Errors) return;

if(' '==$CFG->params->i):
 $S=''; $S2='';
 foreach($Fld as $k=>$v):
  if(strlen($S)) $S.=",";
  $S.="\n\t[$k]";
  if(strlen($S2)) $S2.=",";
  $S2.="\n\t".dbEscape($CFG->entry->$k);
 endforeach;
 $S="Insert Into orders(".$S.")\nValues(".$S2.")";
 @mssql_query($S);
 $Err=dbError();
 if(!$Err): $CFG->params->i=dbLastId(); endif;
else:
 $S='';
 foreach($Fld as $k=>$v):
  if(strlen($S)) $S.=",";
  $S.="\n\t[$k]=".dbEscape($CFG->entry->$k);
 endforeach;
 $S="Update orders Set".$S."\nWhere id=".$CFG->params->i;
 @mssql_query($S);
 $Err=dbError();
endif;

if($Err):
  $CFG->Errors->General="SQL error #$Err!";
  return;
endif;

$L='';
foreach($CFG->entry As $k=>$v)
 if(preg_match('/^c(\d+)$/', $k, $match) and $v):
  $L.=', '.$match[1];
 endif;
$L=strlen($L)? substr($L, 2) : "''";

@mssql_query(<<<SQL
Delete From o2c Where [order]={$CFG->params->i} And Not cam in($L)
Insert Into o2c([order], cam)
 Select {$CFG->params->i}, cam.id
    From cam Left Join o2c On cam.id=o2c.cam And o2c.[order]={$CFG->params->i}
    Where cam.id in($L) And o2c.[order] Is Null
SQL
);

header('Location: ./'.hRef());

?>
