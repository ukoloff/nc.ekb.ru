<?
LoadLib('/ldapmod');

$x=new dn($CFG->gdn);
$x->Cut();
$x=$x->ufn();
if(ldapDelete($CFG->gdn))
  Header("Location: ../ou/".hRef('x', null, 'ou', $x->str()));
?>
