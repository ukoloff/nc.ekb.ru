<?
LoadLib('/ADx');

$CFG->entry->f=0+trim($_POST['f']);
$CFG->entry->o=$_POST['o'];

$d=new DN($CFG->udn);
$d=$d->Cut();
$Z=ldapPrepareRename($CFG->udn, $CFG->entry->o[$CFG->entry->f], 'cn', $d['cn']);
ldapRename($Z);

Header('Location: ./'.hRef('x'));

?>
