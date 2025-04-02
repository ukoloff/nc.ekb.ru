<?
require('../../lib/uxm.php');
LoadLib('/ldapmod');

uxmHeader('Ñץולא LDAP');
?>
<H1>Ñץולא LDAP</H1>
<PRE>
<?
$q=ldap_search($CFG->h, "CN=Schema,CN=Configuration,".$CFG->Base, "cn=sendm*", Array());
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);
$dn=$e[0]['dn'];
echo utf2html($dn);
$odn=new dn($dn);
$odn->Cut();
echo "<BR />";
echo utf2html($odn->str());


#ldap_rename($CFG->h, $dn, $odn->str(), 'Sendmail-MTA', true);
ldap_delete($CFG->h, $dn);
echo "<BR />";
echo ldap_error($CFG->h);
?>


</body></html>


