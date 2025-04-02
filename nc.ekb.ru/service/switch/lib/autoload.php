<?
ini_set('display_errors', true);
ini_set('log_errors', false);

if(!function_exists('sqlite3_open')) dl('sqlite3.so');
$Path=dirname(__FILE__)."/../data/main.db";
$CFG->db=sqlite3_open($Path);

setlocale(LC_ALL, "ru_RU.cp1251");

function sqlite3_escape($S)
{
 if(isset($S)) return "'".strtr($S, array("'"=>"''"))."'";
 return 'NULL';
}

?>
