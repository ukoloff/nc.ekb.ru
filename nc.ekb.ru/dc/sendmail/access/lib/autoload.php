<?
$CFG->DIT->Root.="/".($CFG->Sendmail->Map=$CFG->relPath[count($CFG->relPath)-1]);

$CFG->Sendmail->Class='Map';
$CFG->Sendmail->Grouping='MapName';

$f=dirname(__FILE__)."/ini.".$CFG->Sendmail->Map.".php";
if(file_exists($f)) require_once($f);

?>