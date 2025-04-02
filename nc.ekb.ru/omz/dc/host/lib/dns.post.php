<?
global $CFG;

$q=ldap_search($CFG->AD->h, "CN=MicrosoftDNS,CN=System,".$CFG->AD->baseDN, '(&(objectClass=dnsNode)(dc='.str2ldap(substr($CFG->params->u, 0, -1)).'))', array('1.1'));
for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e))
 ldap_delete($CFG->AD->h, ldap_get_dn($CFG->AD->h, $e));

Header('Location: ./'.hRef());
?>