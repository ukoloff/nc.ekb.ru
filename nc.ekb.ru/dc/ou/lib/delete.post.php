<?
if(!$CFG->may):
 Header("Location: ./".hRef('x', null));
 return;
endif;

LoadLib('/ldapmod');

ldapDelete($CFG->odn->str());
$x=$CFG->odn;
$x->Cut();
$x=$x->ufn();
Header("Location: ./".hRef('x', null, 'ou', $x->str()));

?>
