Исправляем организацию, у кого стоит '-'.
<?
$z=new UFN('');
$z=$z->dn();
$q=ldap_search($CFG->AD->h, $z->str(), '(&(objectCategory=user)(company=-))', Array('1.1'));
for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
 $dn=ldap_get_dn($CFG->AD->h, $e);
 $z=new DN($dn);
 $z=$z->ufn();
 if(preg_match('#^Внешние($|/)#i', $z->str())) continue;
 echo "<LI>", $z->str();
 ldap_modify($CFG->AD->h, $dn, Array(company=>Array(utf8('Уралхиммаш'))));
endfor;
?>
