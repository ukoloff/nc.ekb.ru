<?
global $CFG;

if(!function_exists('sqlite3_open')) dl('sqlite3.so');

$CFG->h=sqlite3_open(':memory:');

foreach(glob('/var/spool/nw/*.db') as $f):
 $s=basename($f, '.db');
 sqlite3_exec($CFG->h, "Attach '$f' As $s");
 $CFG->nwServers[]=$s;
endforeach;

LoadLib('nw.'.($_REQUEST['id']?'item':'list'));

?>
