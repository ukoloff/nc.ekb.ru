<?
setlocale(LC_ALL, "ru_RU.cp1251");

//if(!function_exists('sqlite3_open')) dl('sqlite3.so');

$Path=dirname(dirname(__FILE__))."/data/origins.sq3";
$CFG->db=sqlite3_open($Path);

/*
if(!@odbc_prepare($CFG->odbc, "Select * From Origins"))
 odbc_exec($CFG->odbc, "Create Table Origins(N Integer Primary Key, S VarChar(1024), user VarChar(31), IP VarChar(255))");

if(!@odbc_prepare($CFG->odbc, "Select * From Hist")):
 odbc_exec($CFG->odbc, "Create Table Hist(N Integer Primary Key, oId Integer, TimeStamp Integer, Note VarChar(1024))");
 odbc_exec($CFG->odbc, "Create Index iHO On Hist(oId, TimeStamp Desc)");
 odbc_exec($CFG->odbc, "Create Index iHT On Hist(TimeStamp)");
endif;
*/
if($_SERVER['HTTPS'] and $CFG->Auth>0 and 'stas'==$CFG->u) $CFG->Editor=1;

foreach(Array('lines'=>25, 'pages'=>40) as $p=>$def):
 $CFG->defaults->$p=$def;
 $n=(int)$_REQUEST[$p];
 if($n<=1) $n=$def;
 $CFG->params->$p=$n;
endforeach;

function Sorter(&$a, &$b)
{
 return strcoll($a->S, $b->S);
}

//��������� ��� �������� ��� ������ �� �������
function Load($Filter=null)
{
 global $CFG;
 unset($CFG->Origins);
 $x=sqlite3_query($CFG->db, "Select * From Origins");
 while($rr=sqlite3_fetch_array($x)):
  unset($r);
  foreach($rr as $k=>$v) $r->$k=$v;
  if($Filter and !$Filter($r->S)) continue;
  $CFG->Origins[]=$r;
 endwhile;
 sqlite3_query_close($x);
 usort($CFG->Origins, Sorter);
}

?>
