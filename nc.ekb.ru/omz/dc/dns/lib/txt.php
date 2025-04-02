<?
if($CFG->entry->plain):
 LoadLib('asdb');
 tree2text($CFG->Tree);
else:
 LoadLib('tree.txt');
endif;

?>
