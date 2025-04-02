<?
global $CFG;
LoadLib('/userPhoto');

$q=getPhoto($CFG->udn);
if(strlen($q)):
  apache_setenv('no-gzip', '1');	# Disable gzip output
  Header('Content-Type: image/jpg');
  Header("Content-disposition: attachment; filename=\"{$CFG->params->u}.jpg\"");
  echo $q;
  exit;
endif;

Header('HTTP/1.0 404');
//uxmHeader('Нет фотографии');
//echo "<H1 Class='Error'>Нет фотографии</H1>";
exit;
?>
