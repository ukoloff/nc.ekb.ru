<? // Set userPrincipalName if it is not set
//if('stas'!=$CFG->u) return;
$e=getEntry($CFG->udn, 'userPrincipalName');
if($e['count']) return;
@ldap_mod_add($CFG->AD->h, $CFG->udn, Array(userPrincipalName=>$CFG->params->u.'@omzglobal.com'));
?>
