<?
$e=getEntry($CFG->udn, 'userAccountControl msSFU30NisDomain msExchHideFromAddressLists');
$CFG->entry->disable=$e['useraccountcontrol'][0]&uac_ACCOUNTDISABLE;
$CFG->entry->nopass=$e['useraccountcontrol'][0]&uac_PASSWD_NOTREQD;
$CFG->entry->dontExpire=$e['useraccountcontrol'][0]&uac_DONT_EXPIRE_PASSWORD;
$CFG->entry->nis=$e['mssfu30nisdomain'][0];
$CFG->entry->noGAL=!!$e['msexchhidefromaddresslists'][0];
foreach($CFG->rList as $k=>$v):
 $n="g".$k;
 $CFG->entry->$n=inGroup($k, $CFG->params->u);
endforeach;

/*
$L=sqlGet("Select limitMb, freeMb From limits Where u='".AddSlashes($CFG->params->u)."'");
$CFG->entry->limit=$L->limitMb;
$CFG->entry->free=$L->freeMb;
*/
?>
