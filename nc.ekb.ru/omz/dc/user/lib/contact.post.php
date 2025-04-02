<?
LoadLib('/ADx');

// Забираем основные атрибуты от пользователя
foreach($CFG->Fields as $k=>$v)
 $R[$k]=utf8($CFG->entry->$k=trim($_POST[$k]));
unset($R[cn]);
unset($R[ou]);

$CFG->entry->imgURL=trim($_POST['imgURL']);

if(!preg_match('/^\\d*$/', $CFG->entry->employeeID))
  $CFG->Errors->employeeID='Допустимы только цифры';

if(!$CFG->udn):		// Создание объекта
 $R['sAMAccountName']=strtolower(utf8($CFG->entry->u=trim($_POST['u'])));
 $R['objectClass']='user';
 if(!preg_match('/^[\\w\\.\\-]+$/', $CFG->entry->u)):
  $CFG->Errors->u='Недопустимое имя';
 elseif(accountUsed($CFG->entry->u)):
  $CFG->Errors->u='Имя занято';
 endif;
endif;

// Обрабатываем cn и ou
$New=ldapPrepareRename($CFG->udn, $CFG->entry->ou, 'cn', $CFG->entry->cn);
if($New->Errors->ou) $CFG->Errors->ou=$New->Errors->ou;
if($New->Errors->val) $CFG->Errors->cn=$New->Errors->val;

if($CFG->Errors) return;

if($CFG->udn):			// update
 if(ldapModify($CFG->udn, $R) and ldapRename($New)):
  Header("Location: ./".hRef());
  updatePhoto();
  return;
 endif;
else:				// new
 if(ldapCreate($New, $R)):
  Header("Location: ./".hRef('x', 'created', 'u', $CFG->entry->u));
  updatePhoto();
  return;
 endif;
endif;

$CFG->Error=$CFG->ldapError;

function updatePhoto()
{
 global $CFG;
 if(!preg_match('|^([\w]+)/(\S+)$|', $CFG->entry->imgURL, $Match)) return;

 unset($CFG->users);
 $dn=user2dn($CFG->params->u);
 if(!$dn) return;

 LoadLib('/dc/db/'.$Match[1].'.photo');
 $X[]=getJPG($Match[2]);
 ldap_modify($CFG->AD->h, $dn, Array(thumbnailPhoto=>$X, jpegPhoto=>$X));
}

?>
