<H2>Создание ящика</H2>
<!--
&raquo;
Уведомить о
<A hRef="/dc/user/<?=hRef('u', $CFG->uxm, 'x', 'mail', 'subject', 'xch')?>" Target='_blank'>начале миграции</A>
<P />
-->
<?
/*
unset($A2);
$A2[]="\"SMTP:{$CFG->params->u}@ekb.ru\"";
$A2[]="\"smtp:{$CFG->params->u}@migrationomzglobal.com\"";
if($CFG->params->u!=$CFG->uxm)
  $A2[]="\"smtp:{$CFG->uxm}@ekb.ru\"";

$CFG->entry->PoSH="Enable-Mailbox '{$CFG->AD->Domain}\\{$CFG->params->u}' ".
    "-Alias '{$CFG->params->u}' -Database 'mbx-ekbh01' {$CFG->DC} | ".
    "Set-Mailbox -EmailAddressPolicyEnabled:\$false -EmailAddresses (".join(', ', $A2).") {$CFG->DC}";
*/

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

$mdbs = explode(' ', 'mbx-ekbh02 mbx-ekbh03 mbx-ekbh04 mbx-ekbh05 mbx-ekbh06 mbx-ekbh08');
$mdbz = $mdbs[array_rand($mdbs)];

if(!$CFG->entry->PoSH):
  $CFG->entry->PoSH="Enable-Mailbox '{$CFG->AD->Domain}\\{$CFG->params->u}' ".
    "-Alias '{$CFG->params->u}' -Database '$mdbz' {$CFG->DC} ".
    "-PrimarySmtpAddress '{$kn}'";
endif;

/*
$CFG->entry->PoSH="Enable-Mailbox '{$CFG->AD->Domain}\\{$CFG->params->u}' ".
    "-Alias '{$CFG->params->u}' -Database 'mbx-ekbh01' {$CFG->DC} ".
    "-PrimarySmtpAddress '{$CFG->params->u}@ekb.ru'";
*/


//$CFG->entry->alias=$CFG->uxm.":\t{$CFG->params->u}@migrationomzglobal.com";

Input('PoSH', 'Настройка Exchange');
BR();
$CFG->entry->hello = 1;
CheckBox('hello', 'Послать приветственное письмо');
/*
BR();
Input('alias', 'Настройка sendmail');
*/
//echo "<PRE>"; print_r($CFG); echo "</PRE>";
?>
