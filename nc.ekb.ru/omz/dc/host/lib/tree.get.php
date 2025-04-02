<?
unset($OUs);
# $OUs[]='../Computers';
$OUs[]='EKBH/Computers';
$OUs[]='GHM/Computers';
$OUs[]='../UMZ/Computers';
if(inGroupX('#modifyDIT'))
  $OUs[]='/Servers/servers-ekb-uhm/uxm';

foreach($OUs As $OU):
 $z=new ufn($OU);
 $z=$z->dn();
 echo "<!--", $z->str(), "-->";
 $d=new DN($CFG->udn);
 $d->Cut();
 $d=$d->ufn();
 $q=ldap_search($CFG->AD->h, $z->str(), 'objectClass=organizationalUnit');
 for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
  $x=ldap_get_dn($CFG->AD->h, $e);
  $z=new DN($x);
  $z=$z->ufn();
  $z=$z->str();
  $CFG->entry->o[]=$z;
 endfor;
endforeach;

$CFG->entry->f=0;
?>
