<?

require_once 'transliterate.php';
$ksn=getEntry($CFG->udn, 'sn');
$ksn=$ksn['sn'][0];

if(!$ksn)$ksn=$CFG->params->u;

$kgivenName=getEntry($CFG->udn,'givenName');
$kgivenName=$kgivenName['givenname'][0];
 if(!$kgivenName)
    {
     $kn=$ksn."@omzglobal.com";
    }
    else
    {
     $kn=$kgivenName.".".$ksn."@omzglobal.com";
    }
$kn=transliterate(utf2html($kn));

$CFG->entry->Command='Подключить к Lync';
//$CFG->entry->PoSH="Enable-CSUser '{$CFG->AD->Domain}\\{$CFG->params->u}' -SipAddressType UserPrincipalName -RegistrarPool srvsfb-ekbh1.omzglobal.com";
$CFG->entry->PoSH="Enable-CSUser '{$CFG->AD->Domain}\\{$CFG->params->u}' -RegistrarPool srvsfb-ekbh1.omzglobal.com -SipAddress 'sip:{$kn}'";
?>