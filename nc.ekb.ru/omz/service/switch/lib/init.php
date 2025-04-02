<?
$CFG->AAA=1;
$CFG->title='Коммутаторы';

if(!$CFG->Auth) return;

unset($CFG->L2);

$q=ldap_search($CFG->AD->h, "DC=uxm,CN=MicrosoftDNS,CN=System,".$CFG->AD->baseDN, '(&(objectClass=dnsNode)(dc=*.switch))');
for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
  $dc=ldap_get_values($CFG->AD->h, $e, 'dc');
  $dc=$dc[0];
  if('@'==$dc) continue;
  if(preg_match('/\.x\.switch$/', $dc)) continue;
  $x=ldap_get_values_len($CFG->AD->h, $e, 'dnsRecord');
  for($i=$x['count']-1; $i>=0; $i--):
    $RR=unpack('vlen/vtype/V5/a*Data', $x[$i]);
    if(1!=$RR['type']) continue;	// A
    $CFG->L2[preg_replace('/\.[^.]*$/', '', $dc)]=join('.', unpack('C4', $RR[Data]));
  endfor;
endfor;

?>