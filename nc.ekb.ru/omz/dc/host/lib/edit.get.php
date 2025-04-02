<?
$e=getEntry($CFG->udn);

foreach($CFG->attrs as $k) $CFG->entry->$k=utf2str($e[strtolower($k)][0]);
?>
