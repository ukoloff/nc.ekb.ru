<?
LoadLib('/ADx');

unset($X);
foreach($CFG->attrs as $k):
 $X[$k]=utf8($CFG->entry->$k=trim($_POST[$k]));
endforeach;

if(ldapModify($CFG->udn, $X)):
 Header("Location: ./".hRef());
 return;
endif;

$CFG->Error=$CFG->ldapError;
?>
