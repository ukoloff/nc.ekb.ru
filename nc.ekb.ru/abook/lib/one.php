<?
global $CFG;
$CFG->params->u=dn2user($CFG->udn);

foreach(explode(' ', 'vcf crt jpg') as $x)
  if(isset($_GET[$x])):
   LoadLib($x);
   exit;
  endif;
LoadLib('user');
?>
