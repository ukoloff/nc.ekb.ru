<?
LoadLib('/ldapmod');
$X['desktopProfile']=utf8($CFG->entry->script=trim($_POST['script']));
if($CFG->udn)
 $X['scriptPath']=utf8($CFG->entry->scriptPath=trim($_POST['scriptPath']));
 
if(ldapModify($CFG->ldn, $X)):
 Header("Location: ./".hRef());
 return;
endif;

$CFG->Error=$CFG->ldapError;
?>
