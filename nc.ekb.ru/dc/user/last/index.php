<?
global $CFG;
require('../../../lib/uxm.php');

uxmHeader('Последние юзверя');
?>
<H1>Последние юзверя</H1><OL>
<?
$q=ldap_search($CFG->h, $CFG->Base, 'objectCategory=user');
//ldap_sort($CFG->h, $q, 'whenCreated');
$N=0;
for($e=ldap_first_entry($CFG->h, $q); $e; $e=ldap_next_entry($CFG->h, $e)):
  echo "<LI>", utf2html(ldap_get_dn($CFG->h, $e));
//  if($N++>20) break;
endfor;
//echo $q;
?>


</body></html>
