<?
LoadLib('/sqlite');

$Z=dirname(dirname(__FILE__)).'/data/mig.db';
$X=!file_exists($Z);
$CFG->db=sqlite3_open($Z);
if($X) sqlite3_exec($CFG->db, file_get_contents(preg_replace('/\.[^.]*$/', '.sql', $Z)));

?>
