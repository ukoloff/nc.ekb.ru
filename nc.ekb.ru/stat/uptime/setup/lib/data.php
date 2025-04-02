<?
$q=sqlite3_query($CFG->db, "Select * From Attrs");
while($r=sqlite3_fetch_array($q)):
 $CFG->Attrs[]=$r;
 unset($r);
endwhile;
sqlite3_query_close($q);
?>
