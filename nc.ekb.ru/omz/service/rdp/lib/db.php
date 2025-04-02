<?
LoadLib('/sqlite');

$Path=dirname(__FILE__)."/../data/data.db";
$CFG->db=sqlite3_open($Path);
if(!filesize($Path))
  sqlite3_exec($CFG->db, file_get_contents(preg_replace('/\.[^.]*$/', '.sql', $Path)));

unset($Path);

sqlite3_exec($CFG->db, "Delete From Z Where Expire<datetime('now')");

?>
