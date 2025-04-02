<?
$S1="Insert Into Mig(IP";
$S2=") Values('{$_SERVER['REMOTE_ADDR']}'";

foreach(explode(' ', 'uD u Host Room Phone Directum dSig C1 uDN cDN appData winVer Notes') As $k):
  $S1.=", ".$k;
  $S2.=", ".sqlite3_escape(utf2str($_POST[$k]));
endforeach;

sqlite3_exec($CFG->db, $S1.$S2.")");

Header('X-No: '.sqlite3_last_insert_rowid($CFG->db));
?>
