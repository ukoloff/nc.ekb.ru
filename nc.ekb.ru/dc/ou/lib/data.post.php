<?
LoadLib('/ldapmod');

// «абираем основные атрибуты от пользовател€
foreach($CFG->Fields as $k=>$v):
 $CFG->entry->$k=$x=trim($_POST[$k]);
 if('cn'==$k) continue;
 $R[$k]=utf8($x);
endforeach;

if(!$CFG->odn):		// create
 $R['objectClass']='organizationalUnit';
endif;

if(!$CFG->odn or($CFG->params->ou!='' and $CFG->params->ou!='/'))
  $New=ldapPrepareRename($CFG->odn? $CFG->odn->str() : '', 
    $CFG->entry->in=trim($_POST['in']), 'ou', $CFG->entry->o=trim($_POST['o']));

if($New->Errors->ou) $CFG->Errors->in=$New->Errors->ou;
if($New->Errors->val) $CFG->Errors->o=$New->Errors->val;

$ufn= $New->dnNew? $New->dnNew : $CFG->odn;
$ufn=$ufn->ufn();
$ufn=$ufn->str();

if($CFG->Errors) return;

if($CFG->odn):	// update
 if(ldapModify($CFG->odn->str(), $R) and ldapRename($New)):
  Header("Location: ./".hRef('ou', $ufn));
  return;
 endif;
else:		// new
 if(ldapCreate($New, $R)):
  Header("Location: ./".hRef('x', null, 'ou', $ufn));
  return;
 endif;
endif;

$CFG->Error=$CFG->ldapError;
?>
