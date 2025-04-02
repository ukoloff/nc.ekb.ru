<?
global $CFG;

require("../../lib/uxm.php");

$Lib='all';
if(isset($_GET['h'])):
  $Lib='run';
elseif($_GET['n']):
 $Lib='one';
 if(isset($_GET['port']))
  $Lib='port';
 elseif($_GET['m'])
  $Lib='two';
endif;
  
LoadLib($Lib);

$s=sqlite3_query($CFG->db, "Select strftime('%s', Max(Start)) From Run Where Status>0");
$r=sqlite3_fetch($s);
sqlite3_query_close($s);
$r=$r[0];
echo "<HR><Small><Center>Данные получены с коммутаторов в <A hRef='./?h'>", strftime('%X %x', $r), "</A>";
?>

</body></html>
