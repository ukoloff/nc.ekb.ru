<?
$q=sqlite3_query($CFG->db, "Select ParentNo From Tests Where No=".$CFG->params->n);
$r=sqlite3_fetch($q);
sqlite3_query_close($q);
$CFG->entry->p=$r[0];
?>