<?
ini_set('display_errors', true);
ini_set('log_errors', false);

require("../../lib/uxm.php");
global $CFG;

$udn=id2dn('stas');
echo utf2html($udn);

$q=ldap_search($CFG->h, $CFG->Base, '(member:1.2.840.113556.1.4.1941:=('.$udn.'))', Array('1.1'));
print_r($q);
echo "<BR />N=", ldap_count_entries($CFG->h, $q), "<BR />";
print_r(ldap_get_entries($CFG->h, $q));
?>