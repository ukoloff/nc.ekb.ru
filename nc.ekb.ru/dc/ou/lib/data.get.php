<?
$e=getEntry($CFG->odn->str(), array_keys($CFG->Fields));
foreach($CFG->Fields as $k=>$v):
 $CFG->entry->$k=utf2str($e[strtolower($k)][0]);
endforeach;

$dn=$CFG->odn;
$cn=$dn->Cut();
$CFG->entry->o=utf2str($cn['OU']);
if($ufn=$dn->ufn()):
 $CFG->entry->in=$ufn->str();
else:
 $CFG->entry->in='/';
 $CFG->entry->o='<нет>';
endif;
?>
