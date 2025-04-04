<?
function getPhoto($udn)
{
 global $CFG;

 $q=@ldap_read($CFG->h, $udn, 'objectClass=*', Array('jpegPhoto'));
 $q=@ldap_first_entry($CFG->h, $q);
 $q=@ldap_get_values_len($CFG->h, $q, 'jpegPhoto');
 if($q) return $q[0];
 $q=getEntry($udn, 'employeeID');
 $q=utf2str($q[$q[0]][0]);
 if(file_exists($fn=$_SERVER['DOCUMENT_ROOT']."/img/photo/$q.jpg")) return file_get_contents($fn);
 return;
}

function hasPhoto($udn)
{
 global $CFG;

 $q=@ldap_read($CFG->h, $udn, 'jpegPhoto=*', Array('1.1'));
 $q=@ldap_first_entry($CFG->h, $q);
 if($q) return true;
 $q=getEntry($udn, 'employeeID');
 $q=utf2str($q[$q[0]][0]);
 return file_exists($_SERVER['DOCUMENT_ROOT']."/img/photo/$q.jpg");
}

?>
