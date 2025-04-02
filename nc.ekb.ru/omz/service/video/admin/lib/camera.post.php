<?
if('#'==$_POST['i']{0}):	// Delete
 if(preg_match('/\d+/', $_POST['i'], $M))
   @mssql_query('Delete From cam Where ID='.$M[0]);
 header('Location: ./'.hRef('x', 'cameras'));
 exit;
endif;

$CFG->params->i=(' '==$_POST['i']?' ':(int)trim($_POST['i']));

$Fld=Array(Host=>1, name=>1, comment=>0, user=>1, pass=>1, skip=>0, lat=>0, lon=>0, vendor=>0);

foreach($Fld as $k=>$v):
  $CFG->entry->$k=trim($_POST[$k]);
  if($v and !strlen($CFG->entry->$k)) $CFG->Errors->$k='Введите данные';
endforeach;
$CFG->entry->skip=!!$CFG->entry->skip;
deg('lon');
deg('lat');

if($CFG->Errors) return;

if(' '==$CFG->params->i):
 $S=''; $S2='';
 foreach($Fld as $k=>$v):
  if(strlen($S)) $S.=",";
  $S.="\n\t[$k]";
  if(strlen($S2)) $S2.=",";
  $S2.="\n\t".dbEscape($CFG->entry->$k);
 endforeach;
 $S="Insert Into cam(".$S.")\nValues(".$S2.")";
 @mssql_query($S);
 $Err=dbError();
 if(!$Err): $CFG->params->i=dbLastId(); endif;
else:
 $S='';
 foreach($Fld as $k=>$v):
  if(strlen($S)) $S.=",";
  $S.="\n\t[$k]=".dbEscape($CFG->entry->$k);
 endforeach;
 $S="Update cam Set".$S."\nWhere id=".$CFG->params->i;
 @mssql_query($S);
 $Err=dbError();
endif;

if($Err)
  $CFG->Errors->General="SQL error #$Err!";
else
 header('Location: ./'.hRef());

function deg($n)
{
 global $CFG;
 $v=$CFG->entry->$n;
 if(!strlen($v)):
  unset($CFG->entry->$n);
  return;
 endif;
 if(preg_match('/^(\+|-|)\d+(\.\d*)?$/', $v)) return;
 if(preg_match('/^(\+|-|)(\d+)\D+(\d+)(\D+(\d+(\.\d*)?\D*))?$/', $v, $match)):
  $CFG->entry->$n=('-'==$match[1]?'-':'').
    ($match[2]+($match[3]+$match[5]/60)/60);
  return;
 endif;
 $CFG->Errors->$n='Неверное число';
}

?>
