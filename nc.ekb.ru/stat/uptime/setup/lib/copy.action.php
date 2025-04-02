<?
global $CFG;

if(!copy($CFG->sqlFile, $CFG->newFile))
  $CFG->Errors->newf='Ошибка копирования';
?>
