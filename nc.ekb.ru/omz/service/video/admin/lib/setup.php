<?
LoadLib('db');

foreach(explode(' ', 'jpg relay ptz') as $x)
 if(isset($_REQUEST[$x])):
   LoadLib($x);
   exit;
 endif;

if(isset($_REQUEST['admin']) and $CFG->Dispatcher)
  LoadLib('admin');

function cFilter()
{
 global $CFG;
// if($CFG->params->admin) return;
 $q=mssql_query("Select cameras, lists From login Where login='{$CFG->u}'");
 $r=mssql_fetch_row($q);
 if(!$r) return;
 $L=$r[0];
 $r=preg_split('/\D+/', $r[1], null, PREG_SPLIT_NO_EMPTY);
 if(!count($r)) $r[0]=0;
 $q=mssql_query("Select cameras From list Where id in(".join(', ', $r).")");
 while($r=mssql_fetch_row($q))
   $L.='; '.$r[0];
 $r=preg_split('/\D+/', $L, null, PREG_SPLIT_NO_EMPTY);
 if(!count($r)) return;
 return ' And id in ('.join(', ', $r).')';
}

function getCamera()
{
 $n=(int)trim($_REQUEST['n']);
 if($n<=0) return;
 return mssql_fetch_object(mssql_query("Select *, (Select path From vendors Where id=vendor) As path From cam Where id=$n And skip=0".cFilter()));
}

?>
