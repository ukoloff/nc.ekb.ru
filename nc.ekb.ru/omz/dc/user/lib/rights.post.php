<?
LoadLib('/ADx');

foreach(Array('disable', 'dontExpire', 'limit', 'free', 'notify', 'noGAL') as $p)
  $CFG->entry->$p=trim($_POST[$p]);

#echo "<!--"; print_r($CFG->entry); echo "-->";

foreach(Array('limit', 'free') as $k)
 if(!preg_match('/^\d*$/', $CFG->entry->$k))
  $CFG->Errors->$k='Введите число или ничего';

updateLimits();
/**********************************************************************************************
if(!$CFG->Errors):
 $u="'".strtolower(AddSlashes($CFG->params->u))."'";
 $L=sqlGet("Select limitMb, freeMb From limits Where u=$u");
 if($L->limitMb!=$CFG->entry->limit or $L->freeMb!=$CFG->entry->free)
  if(!inGroupX('#modifyDIT')):
   $CFG->Errors->free='А ты кто такой?';
   $CFG->Errors->limit='Тот же самый вопрос';
  elseif(''==$CFG->entry->limit and ''==$CFG->entry->free):
   mysql_query("Delete From limits Where u=$u");
  elseif(mysql_affected_rows(mysql_query("Update limits Set freeMb=".n2sql($CFG->entry->free).
    ", limitMb=".n2sql($CFG->entry->limit)." Where u=$u"))<1):
   mysql_query("Insert Into limits(u, freeMb, limitMb) Values($u, ".n2sql($CFG->entry->free).
    ", ".n2sql($CFG->entry->limit).")");
  endif;
endif;
**********************************************************************************************/


/*
elseif(sqlGet("Select limitMb From limits Where u=$u")==$CFG->entry->limit):
// Nothing
elseif(!inGroupX('#modifyDIT')):
 $CFG->Errors->limit='А ты кто такой?';
else:
 $n=mysql_num_rows(mysql_query("Select * From limits Where u=$u"));
 if(''!=$CFG->entry->limit)
  mysql_query($n? 
    "Update limits Set limitMb={$CFG->entry->limit} Where u=$u" : 
    "Insert Into limits(u, limitMb) Values($u, {$CFG->entry->limit})");
 elseif($n)
  mysql_query("Delete From limits Where u=$u");
endif;
*/

foreach($CFG->rList as $k=>$v):
 $n="g$k";
 if(ldapGroupAdd(group2dn($k), $CFG->udn, !($CFG->entry->$n=trim($_POST[$n])))) continue;
 $CFG->Errors->$n=$CFG->ldapError;
endforeach;

if($CFG->Errors) return;

$e=getEntry($CFG->udn, 'userAccountControl');

$uac=$e['useraccountcontrol'][0];
if($CFG->entry->disable):
 if($uac&uac_ACCOUNTDISABLE) $CFG->entry->notify=0;
 $uac|=uac_ACCOUNTDISABLE;
elseif($uac & uac_ACCOUNTDISABLE):
 $uac^=uac_ACCOUNTDISABLE;
 $CFG->entry->notify=0;
endif;

if($CFG->entry->dontExpire)
 $uac|=uac_DONT_EXPIRE_PASSWORD;
elseif($uac & uac_DONT_EXPIRE_PASSWORD)
 $uac^=uac_DONT_EXPIRE_PASSWORD;

if($CFG->entry->nopass)
 $uac|=uac_PASSWD_NOTREQD;
elseif($uac & uac_PASSWD_NOTREQD)
 $uac^=uac_PASSWD_NOTREQD;

$X['userAccountControl']=$uac;
$X['mssfu30nisdomain']=$CFG->entry->nis ? '*' : '';
//$X['mail']=$CFG->entry->nis? $CFG->params->u.'@ekb.ru' : '';

$X['msexchhidefromaddresslists'] = $CFG->entry->noGAL ? Array('TRUE') : Array();

if(ldapModify($CFG->udn, $X)):
 if($CFG->entry->notify)disableNotify();
 Header("Location: ./".hRef());
else:
 $CFG->Error=$CFG->ldapError;
endif;

function n2sql($n)
{
 return ''==$n?'NULL':$n;
}

function updateLimits()
{
 global $CFG;
 if($CFG->Errors) return;

 $u="'".strtolower(AddSlashes($CFG->params->u))."'";
 $L=sqlGet("Select limitMb, freeMb From limits Where u=$u");
 if($L->limitMb==$CFG->entry->limit and $L->freeMb==$CFG->entry->free) return;

 if(!inGroupX('#modifyDIT')):
   $CFG->Errors->free='А ты кто такой?';
   $CFG->Errors->limit='Тот же самый вопрос';
   return;
 endif;

 if(''==$CFG->entry->limit and ''==$CFG->entry->free)
   mysql_query("Delete From limits Where u=$u");
 elseif(1>@mysql_affected_rows(mysql_query("Update limits Set freeMb=".n2sql($CFG->entry->free).
    ", limitMb=".n2sql($CFG->entry->limit)." Where u=$u")))
   mysql_query("Insert Into limits(u, freeMb, limitMb) Values($u, ".n2sql($CFG->entry->free).
    ", ".n2sql($CFG->entry->limit).")");
}

function getUsers($Group)
{
 global $CFG;
 $Q[]=id2dn($Group);
 $X[$gdn]=1;
 while(count($Q)):
  $m=getEntry($dn=array_pop($Q), 'member');
  if(!$dn) continue;
  $m=$m['member'];
  for($i=$m['count']-1; $i>=0; $i--):
   if($X[$mdn=$m[$i]]) continue;
   $X[$mdn]++;  
   if(ldap_compare($CFG->AD->h, $mdn, 'objectClass', 'user')) $R[]=$mdn;
   if(ldap_compare($CFG->AD->h, $mdn, 'objectClass', 'group')) $Q[]=$mdn;
  endfor;
 endwhile;
 foreach($R as $dn):
//   $e=getEntry($dn, 'mail');
//   $Q[]=utf2str($e['mail'][0]);
     $Q[]=dn2user($dn).'@ekb.ru';
 endforeach;
 return $Q;
}

function disableNotify()
{
 global $CFG;

 include('Mail.php');

 $To=getUsers($gName='onUserBlock');

 $H=Array();
 $H['From']=$CFG->u;
 $H['To']=$CFG->params->u;
 $H['CC']=headerEncode('Кому положено').'<'.$gName.'@ekb.ru>';
 $H['Subject']=headerEncode('Уведомление о блокировании пользователя');
 $H['X-Mailer']='PHP '.phpversion();
 $H['X-Sent-From']='http'.($_SERVER['HTTPS']?'s':'')."://".$CFG->u.'@'.$_SERVER['SERVER_NAME'].'/omz/';
 $H['X-IP-From']=$_SERVER['REMOTE_ADDR'].' '.$_SERVER["HTTP_X_FORWARDED_FOR"];
 $H["Organization"]="UralKhimMash <http://ekb.ru>";
 $H["MIME-Version"]='1.0';
 $H["Content-Type"]="text/plain; charset=\"windows-1251\"";
 $H["Content-Transfer-Encoding"]="8bit";

 $Z=&Mail::factory('sendmail', Array('sendmail_args'=>'-i -N never'));
 $Z->send($To, $H, 'Пользователь '.$CFG->params->u." заблокирован в домене.\n\nhttps://ekb.ru/omz/abook/person/?u=".$CFG->params->u.
    "\n\nВероятно, его следует блокировать и в других БД.\n");
}

?>
