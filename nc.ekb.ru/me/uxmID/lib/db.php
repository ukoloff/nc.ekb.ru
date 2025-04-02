<?
global $CFG;

if(!function_exists('sqlite3_open')) dl('sqlite3.so');
$CFG->db=sqlite3_open(dirname(dirname(__FILE__))."/data/auth.sq3");
sqlite3_exec($CFG->db, <<<SQL
Create Table If Not Exists Auth(
 i	VarChar(255) Primary Key,
 u	VarChar(255),
 n	VarChar(255),
 At	DateTime Default CURRENT_TIMESTAMP
);

Create Index If Not Exists iAuth On Auth(At);

Delete From Auth Where At<datetime("now", "-27 seconds");
SQL
);

function sqlite3_escape($S)
{
 if(isset($S)) return "'".strtr($S, array("'"=>"''"))."'";
 return 'NULL';
}

?>
