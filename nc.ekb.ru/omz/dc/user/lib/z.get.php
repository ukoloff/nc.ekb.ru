<?
$e=getEntry($CFG->udn, array_keys($CFG->Fields));
foreach($CFG->Fields as $k=>$v):
 $CFG->entry->$k=utf2str($e[strtolower($k)][0]);
endforeach;

$dn=new dn($CFG->udn);
$dn->Cut();
$ufn=$dn->ufn();
$CFG->entry->ou=$ufn->str();
?>
