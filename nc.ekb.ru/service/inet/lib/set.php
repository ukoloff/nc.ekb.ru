<?
global $CFG;

$z=(int)$_REQUEST['z'];
mysql_query("Insert Into uxmJournal.Provider(u, id, Name, IP) Values ('".AddSlashes($CFG->u)."', $z, '".$CFG->Z[$z]."', '".$_SERVER['REMOTE_ADDR']."')");
exec(dirname(__FILE__)."/set.pl $z");

Header('Location: ./');
?>
