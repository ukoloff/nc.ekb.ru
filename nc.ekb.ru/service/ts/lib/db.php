<?
global $CFG;
#if(!function_exists('sqlite3_open')) dl('sqlite3.so');

$Path=dirname(dirname(__FILE__))."/data/data.db";
$CFG->db=sqlite3_open($Path);
if(!filesize($Path))
  sqlite3_exec($CFG->db, file_get_contents(preg_replace('/\.[^.]*$/', '.sql', $Path)));

unset($Path);

sqlite3_exec($CFG->db, "Delete From Z Where Expire<datetime('now')");

function sqlite3_escape($S)
{
 if(isset($S)) return "'".strtr($S, array("'"=>"''"))."'";
 return 'NULL';
}
?>
