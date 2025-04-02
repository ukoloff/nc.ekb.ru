<?
global $CFG;

if(!rename($CFG->sqlFile, $CFG->newFile))
  $CFG->Errors->newf='Ошибка переименования';

?>
