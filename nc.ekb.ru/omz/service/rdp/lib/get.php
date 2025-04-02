<?
foreach($CFG->Fields as $n=>$v)
  $CFG->entry->$n=trim($_GET[$n]);

unset($X);

if($X=$_COOKIE['port'])
 setcookie('port', false);
else
 $X=trim($_GET['port']);

if(strlen($X)>1):
 $CFG->Connect=2;
 $q=sqlite3_query($CFG->db, 'Select Z.No, Log.Port From Z, Log Where Z.No=Log.No And X='.sqlite3_escape($X));
 $CFG->RDP=sqlite3_fetch_array($q);
 sqlite3_query_close($q);
endif;

if('-'==$X)
{
 $CFG->Connect=1;
}

?>
