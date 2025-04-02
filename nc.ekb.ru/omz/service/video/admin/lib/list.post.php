<?
if('#'==$_POST['i']{0}):	// Delete
 if(preg_match('/\d+/', $_POST['i'], $M))
   @mssql_query('Delete From list Where ID='.$M[0]);
 header('Location: ./'.hRef('x', 'lists'));
 exit;
endif;

$CFG->params->i=(' '==$_POST['i']?' ':(int)trim($_POST['i']));

$Fld=Array(name=>1, show=>1, comment=>0, cameras=>0);

foreach($Fld as $k=>$v)
  $CFG->entry->$k=trim($_POST[$k]);
$CFG->entry->show=!!$CFG->entry->show;

if(!strlen($CFG->entry->name))$CFG->Errors->name='Имя не задано';

if($CFG->Errors) return;

if(' '==$CFG->params->i):
 $S=''; $S2='';
 foreach($Fld as $k=>$v):
  if(strlen($S)) $S.=",";
  $S.="\n\t[$k]";
  if(strlen($S2)) $S2.=",";
  $S2.="\n\t".dbEscape($CFG->entry->$k);
 endforeach;
 $S="Insert Into list(".$S.")\nValues(".$S2.")";
 @mssql_query($S);
 $Err=dbError();
 if(!$Err): $CFG->params->i=dbLastId(); endif;
else:
 $S='';
 foreach($Fld as $k=>$v):
  if(strlen($S)) $S.=",";
  $S.="\n\t[$k]=".dbEscape($CFG->entry->$k);
 endforeach;
 $S="Update list Set".$S."\nWhere id=".$CFG->params->i;
 @mssql_query($S);
 $Err=dbError();
endif;

if($Err)
  $CFG->Errors->General="SQL error #$Err!";
else
 header('Location: ./'.hRef());

?>