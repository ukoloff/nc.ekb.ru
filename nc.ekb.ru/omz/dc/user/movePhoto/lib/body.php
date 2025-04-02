<?
// Перемещаем фотки из jpegPhoto в thumbnailPhoto

$z=new UFN();
$z=$z->dn();
$z=$z->str();
//echo $z; return;

$q=ldap_search($CFG->AD->h, $z, '(&(jpegPhoto=*)(!(thumbnailPhoto=*)))', Array('jpegPhoto'));
for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
  $dn=ldap_get_dn($CFG->AD->h, $e);
  echo "<LI>", utf2html($dn);

  $X=ldap_get_values_len($CFG->AD->h, $e, 'jpegPhoto');
  unset($X['count']);
  ldap_modify($CFG->AD->h, $dn, Array('thumbnailPhoto'=>$X, 'jpegPhoto'=>Array()));
  echo ldap_error($CFG->AD->h);
//  break;
endfor;
?>
