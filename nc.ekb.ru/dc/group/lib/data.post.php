<?
LoadLib('/ldapmod');

foreach($CFG->Fields as $k):
 $CFG->entry->$k=$x=trim($_POST[$k]);
 if('cn'==$k) continue;
 $R[$k]=utf8($x);
endforeach;

if(preg_match("/[:\\[\\+\\]\\<\\*\\>\\|\\/\\?\\\"\\\\]/", $CFG->entry->sAMAccountName)):
 $CFG->Errors->sAMAccountName='Недопустимые символы';
elseif(accountUsed($CFG->entry->sAMAccountName) and (!$CFG->gdn or $CFG->gdn!=group2dn($CFG->entry->sAMAccountName))):
 $CFG->Errors->sAMAccountName='Имя занято';
endif;

if($CFG->gdn):
 $groupType=getEntry($CFG->gdn, 'groupType');
 $groupType=$groupType[$groupType[0]][0];
  $groupType^=($groupType & (0x80000000+2+4+8));
else:
 $R['objectClass']='Group';
 $groupType=0;
endif;

if('s'==($CFG->entry->type=trim($_POST['type']))) $groupType+=0x80000000;
switch($CFG->entry->scope=trim($_POST['scope']))
{
 case 'g'; $groupType+=2; break;
 case 'd'; $groupType+=4; break;
 case 'u'; $groupType+=8; break;
 default: $CFG->Errors->scope='Не поддерживается';
}
$R['groupType']=$groupType;

// Обрабатываем cn и ou
$New=ldapPrepareRename($CFG->gdn, $CFG->entry->ou=trim($_POST['ou']), 'cn', $CFG->entry->cn);
if($New->Errors->ou) $CFG->Errors->ou=$New->Errors->ou;
if($New->Errors->val) $CFG->Errors->cn=$New->Errors->val;

if($CFG->Errors) return;

if($CFG->gdn):	// update
 if(ldapModify($CFG->gdn, $R) and ldapRename($New)):
  Header("Location: ./".hRef('g', $CFG->entry->sAMAccountName));
  return;
 endif;
else:		// new
 if(ldapCreate($New, $R)):
  Header("Location: ./".hRef('x', null, 'g', $CFG->entry->sAMAccountName));
  return;
 endif;
endif;

$CFG->Error=$CFG->ldapError;

?>
