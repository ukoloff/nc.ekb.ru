<?
global $CFG;
LoadLib('/samba');
$CFG->Samba=new smbClient(netLogonPath());

?>
