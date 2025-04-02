<?
LoadLib('/yaml');

Header('Content-Type: application/vnd.ms-excel');
Header('Content-Disposition: attachment; filename="users.yaml"');

 echo Spyc::YAMLDump(null);

$s=pfxDB()->prepare("Select u, ctime, Revoke, Attrs.*".$CFG->SQL);
$x=$s->execute();
while($r=$x->fetchArray(SQLITE3_ASSOC)):
 echo preg_replace('/^.*?(\r\n?|\n)/', '', Spyc::YAMLDump(Array($r)));
endwhile;

?>
