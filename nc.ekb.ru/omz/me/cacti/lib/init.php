<?
$CFG->title='Cacti';

$CFG->AAA=$CFG->Menu->findItem(preg_replace('/\?.*/', '', $_SERVER[REQUEST_URI]))->href? 1:2;

mysql_query("Delete From cacti Where xtime<Now()");

?>
