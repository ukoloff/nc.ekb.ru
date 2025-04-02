<?
global $CFG;
unlink($CFG->sqlFile);

Header('Location: ./');
?>
