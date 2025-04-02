<?
LoadLib('/ldapmod');

function ClassPost()
{
global $CFG;
foreach(Array('c', 'description', 'items', 'info') as $k)
  $CFG->entry->$k=trim($_POST[$k]);

$CFG->params->cn=trim($_POST['cn']);
$CFG->params->x=trim($_POST['x']);

$R['sendmailMTAClassName']=utf8($CFG->entry->c);
$R['description']=utf8($CFG->entry->description);
$R['info']=utf8($CFG->entry->info);
foreach(preg_split('/\\s*((\\r?\\n)|\\r)\\s*/', $CFG->entry->items) as $x)
  if($x)
    $R['sendmailMTAClassValue'][]=utf8($x);

if(!$CFG->entry->c)
  $CFG->Errors->c='»м€ не задано';
if(!$R['sendmailMTAClassValue'])
  $CFG->Errors->items='ѕустые классы недопустимы';

if('new'!=$CFG->params->x):
 $q=ldap_search($CFG->h, $CFG->Base, 
    "(&(objectClass=sendmailMTAClass)(sendmailMTAHost=".str2ldap($CFG->Sendmail->Domain).
    ")(sendmailMTAClassName=".str2ldap($CFG->params->cn)."))", Array());
 if(1==ldap_count_entries($CFG->h, $q)):
  $e=ldap_get_entries($CFG->h, $q);
  $dn=$e[0]['dn'];
  $Z=new dn($dn);
  $Z->Cut();
  $Z=$Z->ufn();
  $ufn=$Z->str();
 else:
  $CFG->Error=' ласс не найден';
 endif;
 ldap_free_result($q);

else:
 $R['objectClass']='sendmailMTAClass';
 $R['sendmailMTAHost']=$CFG->Sendmail->Domain;
 $q=ldap_search($CFG->h, $CFG->Base, 
    "(&(objectClass=sendmailMTAClass)(sendmailMTAHost=".str2ldap($CFG->Sendmail->Domain)."))", Array());
 if(ldap_count_entries($CFG->h, $q)>0):
  $e=ldap_get_entries($CFG->h, $q);
  $dn=$e[0]['dn'];
  $Z=new dn($dn);
  $Z->Cut();
  $Z=$Z->ufn();
  $ufn=$Z->str();
 else:
  $CFG->Error='¬нутренн€€ ошибка: нет классов, чтобы создать ещЄ один р€дом';
 endif;
 ldap_free_result($q);
 $dn=null;
endif;

$Z=ldapPrepareRename($dn, $ufn, 'cn', $CFG->entry->c);
if($Z->Errors->val) $CFG->Errors->c=$Z->Errors->val;
if($Z->Errors->ou) $CFG->Errors->ou=$Z->Errors->ou;

if($CFG->Errors or $CFG->Error)
 return;

if($dn):	// update
 if(ldapModify($dn, $R) and ldapRename($Z)):
  Header("Location: ./".hRef('c', $CFG->entry->c));
  return;
 endif;
else:		// new
 if(ldapCreate($Z, $R)):
  Header("Location: ./".hRef('x', null, 'c', $CFG->entry->c));
  return;
 endif;
endif;

$CFG->Error=$CFG->ldapError;
}

ClassPost();

?>
