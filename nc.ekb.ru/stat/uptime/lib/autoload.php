<?
setlocale(LC_ALL, "ru_RU.cp1251");

if(!function_exists('sqlite3_open')) dl('sqlite3.so');

$CFG->sqlPath=dirname(dirname(__FILE__))."/data/";

function checkDB()
{
 global $CFG;
 $CFG->params->f=$f=basename(trim($_REQUEST['f']), '.sq3');
 $f=$CFG->sqlFile=$CFG->sqlPath.$f.'.sq3';
 if(!file_exists($f)) return;
 if($CFG->db=sqlite3_open($f)) return true;
 return;
}

?>
