<?
LoadLib('/ldapmod');

foreach(Array('msSFU30GidNumber', 'nis') as $p)
  $CFG->entry->$p=$_POST[$p];

$R['msSFU30NisDomain']=$CFG->entry->nis ? '*' : '';
$R['msSFU30GidNumber']=$CFG->entry->msSFU30GidNumber? $CFG->entry->msSFU30GidNumber : '';

if(!preg_match('/^\\d*$/', $CFG->entry->msSFU30GidNumber)):
 $CFG->Errors->msSFU30GidNumber='ײטפנû האגאי!';
 return;
endif;

if(ldapModify($CFG->gdn, $R)):
 Header("Location: ./".hRef());
 return;
endif;

$CFG->Error=$CFG->ldapError;

?>
