<?
$h=ldap_connect("lan");
ldap_set_option($h, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($h, LDAP_OPT_REFERRALS, 0);
ldap_start_tls($h);
$x=ldap_bind($h, "lan\\".$_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
echo "$h: $x<BR /><PRE>";
$q=ldap_read($h, '', 'ObjectClass=*');
print_r(ldap_get_entries($h, $q));
ldap_get_option ($h, LDAP_OPT_HOST_NAME, $opt);
echo "<HR />$opt";
?>
