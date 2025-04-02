<?
global $CFG;

$q=sqlite3_query($CFG->db, "Select ParentNo From Tests Where No=".$CFG->params->n);
$r=sqlite3_fetch($q);
sqlite3_query_close($q);

if(sqlite3_exec($CFG->db, "Begin Transaction") and DoIt() and sqlite3_exec($CFG->db, 'Commit Transaction')):
 Header('Location: ./'.hRef('n', $r[0], 'x'));
else:
 $CFG->Error=sqlite3_error($CFG->db);
 sqlite3_exec($CFG->db, "Rollback Transaction");
endif;

function DoIt()
{
 global $CFG;
 $ToDo=Array($CFG->params->n);
 while(count($ToDo)):
  $n=array_pop($ToDo);
  $q=sqlite3_query($CFG->db, "Select No From Tests Where ParentNo=$n");
  while($r=sqlite3_fetch($q))
   $ToDo[]=$r[0];
  sqlite3_query_close($q);
  if(!sqlite3_exec($CFG->db, "Delete From Tests Where No=$n")) return;
 endwhile;
 return true;
}

?>
