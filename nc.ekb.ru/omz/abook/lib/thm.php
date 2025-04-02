<?
global $CFG;
	
$q=getPhoto($CFG->udn);
if(strlen($q)):
  apache_setenv('no-gzip', '1');	# Disable gzip output
  Header('Content-Type: image/jpg');
  Header("Content-disposition: attachment; filename=\"{$CFG->params->u}.jpg\"");
  echo $q;
  exit;
endif;

Header('HTTP/1.0 404');

function getPhoto($udn)
{
 global $CFG;

 $q=@ldap_read($CFG->AD->h, $udn, 'objectClass=*', Array('thumbnailPhoto'));
 $q=@ldap_first_entry($CFG->AD->h, $q);
 $q=@ldap_get_values_len($CFG->AD->h, $q, 'thumbnailPhoto');
 if($q) return $q[0];
 $q=getEntry($udn, 'employeeID');
 $q=utf2str($q[$q[0]][0]);
 if(file_exists($fn=$_SERVER['DOCUMENT_ROOT']."/img/photo/$q.jpg")) return file_get_contents($fn);
 return;
}

?>
