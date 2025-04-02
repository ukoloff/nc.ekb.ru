<?
$CFG->params->u=dn2user($CFG->udn);

foreach(explode(' ', 'vcf cer crt pkcs7 jpg thm logon json qr') as $x)
  if(isset($_GET[$x])):
   LoadLib($x);
   exit;
  endif;
LoadLib('get.user');

?>
