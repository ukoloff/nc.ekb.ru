<?
/*
$PoSH = "Get-PSProvider";
$PoSH = "hostx";
//$PoSH = "Enable-Mailbox 'OMZGLOBAL\s.ukolov1' -Alias 's.ukolov1' -Database 'mbx-ekbh08' -DomainController 'srvdc-ekbh5.omzglobal.com' -PrimarySmtpAddress 'stas@omzglobal.com'"
*/

function psEscape($S)
{
 return "'".strtr($S, Array("'"=>"''"))."'";
}

$U=psEscape($CFG->AD->Domain."\\".$CFG->u);
$P=psEscape($_SERVER['PHP_AUTH_PW']);

/*
$z=<<<WPS
\$cred = New-Object System.Management.Automation.PSCredential($U, (ConvertTo-SecureString $P -AsPlainText -Force))
\$sess=New-PSSession -ConfigurationName Microsoft.Exchange -ConnectionUri http://srvmail-ekbh5.omzglobal.com/PowerShell/ -Authentication Kerberos -Credential \$cred
Invoke-Command -Session \$sess -ScriptBlock {{$PoSH}}
Remove-PSSession \$sess
WPS
;

*/

$PoSH = "Enable-Mailbox $U -Alias 's.ukolov1' -Database 'mbx-ekbh08' -DomainController 'srvdc-ekbh5.omzglobal.com' -PrimarySmtpAddress 'stas@omzglobal.com'";
$PoSH = "Disable-Mailbox $U -Confirm:\$false -DomainController 'srvdc-ekbh5.omzglobal.com'";

$cmd = '-ConfigurationName Microsoft.Exchange -ConnectionUri http://srvmail-ekbh5.omzglobal.com/PowerShell/ -Authentication Kerberos -Credential $cred';

/*
$PoSH = "Enable-CSUser $U -RegistrarPool srvsfb-ekbh1.omzglobal.com -SipAddress 'sip:stas@omzglobal.com'";
$PoSH = "Disable-CSUser $U";

$cmd = '-ComputerName srvsfb-ekbh1.omzglobal.com -Credential $cred -Authentication CredSSP';
*/

$cmd = <<<WRAP
    New-PSSessionOption -SkipCACheck -SkipCNCheck -SkipRevocationCheck | Out-Null
    \$cred = New-Object System.Management.Automation.PSCredential($U, (ConvertTo-SecureString $P -AsPlainText -Force))
    \$sess = New-PSSession $cmd
    Invoke-Command -Session \$sess -ScriptBlock { $PoSH }
    Remove-PSSession \$sess
WRAP
;

//echo $cmd; 
//exit();


//echo "[[[$z]]]"; exit;

set_time_limit(0);

 $c=curl_init('https://ad.ekb.ru/pwsh/');
// $c=curl_init('https://uxm00035:444');
// $c=curl_init('https://ad.ekb.ru:444');
 curl_setopt($c, CURLOPT_POST, 1);
 curl_setopt($c, CURLOPT_POSTFIELDS, "Command=".urlencode($cmd));
// curl_setopt($c, CURLOPT_POSTFIELDS, json_encode(Array('Command'=>utf8($cmd))));
 curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($c, CURLOPT_CAINFO, "/var/www/net.ekb.ru/ssl/ca.crt");
 curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
 curl_setopt($c, CURLOPT_USERPWD, $CFG->AD->Domain."\\".$CFG->u.':'.$_SERVER['PHP_AUTH_PW']);
  curl_setopt($c, CURLOPT_TIMEOUT, 400);
 $Res=curl_exec($c);
 echo utf2str($Res);
/*
echo "<!-- ", iconv('866', 'windows-1251', $Res), " -->";
 $Res = json_decode(iconv('866', 'utf-8', $Res));
echo "<!-- ", json_last_error(), " -->";

 echo "<pre>"; print_r($Res);
*/
?>
