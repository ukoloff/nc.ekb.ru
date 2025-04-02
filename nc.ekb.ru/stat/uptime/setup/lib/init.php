<?
global $CFG;

if(sqlite3_exec($CFG->db, file_get_contents($CFG->sqlPath.'/create.sql'))):
  Header('Location: ./'.hRef('x', 'list'));
else:
  $CFG->Error=sqlite3_error($CFG->db);
endif;

?>
