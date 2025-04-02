<?
global $CFG;
LoadLib('/ldapmod');

if(isset($_POST['path']))
 putFile();

if(isset($_POST['scriptPath']))
 $X['scriptPath']=utf8($CFG->entry->scriptPath=$CFG->Samba->winPath(trim($_POST['scriptPath'])));
 
if(!$X or ldapModify($CFG->udn, $X)):
 Header("Location: ./".hRef());
 return;
endif;

$CFG->Error=$CFG->ldapError;

function putFile()
{
 global $CFG;
 $CFG->params->path=$CFG->Samba->winPath(trim($_POST['path']));
 $ff=fopen($fname=$CFG->Samba->tempFile(), 'w');
 $S=join("\r\n", array_map(rtrim, preg_split('/(\r\n?)|\n/', rtrim($_POST['Bat']))));
 fwrite($ff, iconv("CP1251", "CP866//IGNORE", $S));
 fwrite($ff, "\r\n");
 fclose($ff);
 $CFG->Samba->putFile($fname, $CFG->params->path, 1);
}

?>
