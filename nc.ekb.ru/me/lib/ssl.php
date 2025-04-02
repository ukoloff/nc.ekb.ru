<?
ini_set('display_errors', true);
ini_set('log_errors', false);

if(!function_exists('sqlite3_open')) dl('sqlite3.so');

$CFG->dbPath=dirname(__FILE__).'/sql/';
$F=$CFG->dbPath.'/www/www.sq3';
$FX=!file_exists($F);
$CFG->db=sqlite3_open($F);
if($FX)
 sqlite3_exec($CFG->db, file_get_contents($CFG->dbPath.'www.sql'));

sqlite3_exec($CFG->db, 'Attach Database '.sqlite3_escape($CFG->dbPath.'pub/pub.sq3').' As pub');

function sqlite3_escape($S)
{
 if(isset($S)) return "'".strtr($S, array("'"=>"''"))."'";
 return 'NULL';
}

?>
