<?
//doDebug();
$seen = Array();
$max = 0;
$q = ldap_search($CFG->AD->h, $CFG->AD->baseDN, '(&(objectClass=computer)(name=uxm*))', Array('cn'));
for ($e = ldap_first_entry($CFG->AD->h, $q); $e; $e = ldap_next_entry($CFG->AD->h, $e)):
  $cn = ldap_get_values($CFG->AD->h, $e, 'cn');
  $cn = $cn[0];
  if (!preg_match('/^uxm(\d+)$/i', $cn, $matches)) continue;
  $n = (int)$matches[1];
  $seen[$n]=1;
  if ($max < $n) $max = $n;
endfor;
ldap_free_result($q);
$max = 1000;
for ($i = 0; $i <= $max; $i++):
  if ($seen[$i]) continue;
  printf("UXM%05d ", $i);
endfor;
?>
