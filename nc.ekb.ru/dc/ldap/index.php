<?
require('../../lib/uxm.php');
LoadLib('/tabs');

$CFG->tabs=Array('list'=>'������', 'find'=>'�����', 'view'=>'����', 'edit'=>'������');

uxmHeader('LDAP-������');
?>
<H1>LDAP-������</H1>
<?
tabsHeader();


tabsFooter();
?>
