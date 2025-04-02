<?
$e=getEntry($CFG->udn, 'userAccountControl msSFU30NisDomain');
$CFG->entry->disable=$e['useraccountcontrol'][0]&uac_ACCOUNTDISABLE;
$CFG->entry->dontExpire=$e['useraccountcontrol'][0]&uac_DONT_EXPIRE_PASSWORD;
$CFG->entry->nis=$e['mssfu30nisdomain'][0];
foreach($CFG->rList as $k=>$v):
 $n="g".$k;
 $CFG->entry->$n=inGroup($k, $CFG->params->u);
endforeach;

LoadLib('/mysql');
$L=sqlGet("Select limitMb, freeMb From limits Where u='".AddSlashes($CFG->params->u)."'");
$CFG->entry->limit=$L->limitMb;
$CFG->entry->free=$L->freeMb;
?>
