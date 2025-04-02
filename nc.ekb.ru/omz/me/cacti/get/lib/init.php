<?
mysql_query("Delete From cacti Where xtime<Now()");

$q=mysql_query("Select id, mode From cacti Where hash='".AddSlashes($_REQUEST[id])."'");
$q=mysql_fetch_object($q);
if(!$q) exit;

mysql_query("Delete From cacti Where id=".$q->id);

echo "<mode={$q->mode}>";
exit;
?>
