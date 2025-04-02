<?
$e=getEntry($CFG->ldn, 'desktopProfile scriptPath');
$CFG->entry->script=utf2str($e['desktopprofile'][0]);
$CFG->entry->scriptPath=utf2str($e['scriptpath'][0]);
?>
