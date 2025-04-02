<?
$CFG->title='Нет визитки';

if(!($CFG->params->u=trim($_REQUEST['u'])))$CFG->params->u=$CFG->u;

if($CFG->udn=user2dn($CFG->params->u)):
 LoadLib('vcard');
 exit;
endif;

?>
