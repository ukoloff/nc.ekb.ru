<?
require('../../lib/uxm.php');
LoadLib('/tabs');

$CFG->tabs=Array('list'=>'Состав', 'find'=>'Поиск', 'view'=>'Поля', 'edit'=>'Правка');

uxmHeader('LDAP-объект');
?>
<H1>LDAP-объект</H1>
<?
tabsHeader();


tabsFooter();
?>
