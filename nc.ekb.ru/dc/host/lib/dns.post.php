<?
global $CFG;

$q=ldap_search($CFG->h, "CN=MicrosoftDNS,CN=System,".$CFG->Base, '(&(objectClass=dnsNode)(dc='.str2ldap(substr($CFG->params->u, 0, -1)).'))', array('1.1'));
for($e=ldap_first_entry($CFG->h, $q); $e; $e=ldap_next_entry($CFG->h, $e))
 ldap_delete($CFG->h, ldap_get_dn($CFG->h, $e));

Header('Location: ./'.hRef());
?>