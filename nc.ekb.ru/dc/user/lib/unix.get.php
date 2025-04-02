<?
$e=getEntry($CFG->udn, array_keys($CFG->Fields));
foreach($CFG->Fields as $k=>$v):
 $CFG->entry->$k=utf2str($e[strtolower($k)][0]);
endforeach;
?>
