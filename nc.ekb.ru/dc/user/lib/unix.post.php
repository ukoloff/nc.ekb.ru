<?
LoadLib('/ldapmod');

foreach($CFG->Fields as $k=>$v)
 $X[$k]=utf8($CFG->entry->$k=trim($_POST[$k]));

if(!preg_match('/^\\d*$/', $CFG->entry->msSFU30UidNumber)) $CFG->Errors->msSFU30UidNumber='ײטפנû האגאי!';
if(!preg_match('/^\\d*$/', $CFG->entry->msSFU30GidNumber)) $CFG->Errors->msSFU30GidNumber='ײטפנû האגאי!';

if($CFG->Errors) return;

if(ldapModify($CFG->udn, $X)):
 Header("Location: ./".hRef());
 return;
endif;

$CFG->Error=$CFG->ldapError;

?>
