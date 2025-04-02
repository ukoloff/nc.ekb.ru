<?
$X=$CFG->Fields;
$X[]='groupType';
$e=getEntry($CFG->gdn, $X);
foreach($CFG->Fields as $k):
 $CFG->entry->$k=utf2str($e[strtolower($k)][0]);
endforeach;
$t=$e['grouptype'][0];
$CFG->entry->type=$t&0x80000000?'s':'d';
if($t&2)$CFG->entry->scope='g';
elseif($t&4)$CFG->entry->scope='d';
elseif($t&8)$CFG->entry->scope='u';
$dn=new dn($CFG->gdn);
$dn->Cut();
$ufn=$dn->ufn();
$CFG->entry->ou=$ufn->str();
?>
