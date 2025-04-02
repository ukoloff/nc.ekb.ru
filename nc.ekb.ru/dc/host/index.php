<?
global $CFG;
require('../../lib/uxm.php');
LoadLib('/tabs');

$CFG->params->u=$CFG->entry->u=$u=trim($_REQUEST['u']);
$CFG->tabs=Array('sum'=>'Сводка', 'delete'=>'Удалить', 'dns'=>'DNS',); 

if(!$u or !($CFG->udn=user2dn($u))):
  $CFG->tabs=Array('no'=>'Ошибка');
elseif(!ldap_compare($CFG->h, $CFG->udn, 'objectClass', 'computer')):
  Header("Location: ../user/?".$_SERVER['QUERY_STRING']);
  exit;
endif;

tabsBeforeBody();

$title='Компьютер';
if($CFG->udn) $title.=': '.$CFG->params->u;
uxmHeader($title." [".tabName()."]");
?>
<H1>Компьютер</H1>
<?
tabsHeader();
if($CFG->udn):
 LoadLib('../ufn');
 prettyUfn($CFG->udn, $CFG->params->u);
endif;
tabsContent();
tabsFooter();
?>
</body></html>
