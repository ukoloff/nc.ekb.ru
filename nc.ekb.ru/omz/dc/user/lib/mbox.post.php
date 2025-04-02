<?
if(!inGroupX('#modifyDIT')):
 header('Location: ./'.hRef());
 return;
endif;

LoadLib('photo.dup');
dupPhoto();

//echo "<PRE>"; print_r($_POST); echo "</PRE>";

if($PoSH=trim($_POST['PoSH'])):
 $U=psEscape($CFG->AD->Domain."\\".$CFG->u);
 $P=psEscape($_SERVER['PHP_AUTH_PW']);
 $z=<<<WPS
\$cred = New-Object System.Management.Automation.PSCredential($U, (ConvertTo-SecureString $P -AsPlainText -Force))
\$sess=New-PSSession -ConfigurationName Microsoft.Exchange -ConnectionUri http://srvmail-ekbh5.omzglobal.com/PowerShell/ -Authentication Kerberos -Credential \$cred
Invoke-Command -Session \$sess -ScriptBlock {{$PoSH}}
Remove-PSSession \$sess
WPS
;
// echo "<PRE>$z</PRE>"; exit;
// $c=curl_init('https://x-omega/uxm/');
// $c=curl_init('https://ad.ekb.ru/uxm/');
 set_time_limit(0);
//////////////////////////////////////////////////////////////
// Setup PowerShell/HTTP[S] proxy:
//
// https://github.com/ukoloff/posh-sandbox/tree/main/http-pwsh
//////////////////////////////////////////////////////////////
 $c=curl_init('https://ad.ekb.ru/pwsh/');
 curl_setopt($c, CURLOPT_POST, 1);
 curl_setopt($c, CURLOPT_POSTFIELDS, "Command=".urlencode($z));
 curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($c, CURLOPT_CAINFO, "/var/www/net.ekb.ru/ssl/ca.crt");
 curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
 curl_setopt($c, CURLOPT_USERPWD, $CFG->AD->Domain."\\".$CFG->u.':'.$_SERVER['PHP_AUTH_PW']);
 curl_setopt($c, CURLOPT_TIMEOUT, 400);
 $Res=curl_exec($c);
 $Res = json_decode($Res);
 if ($Res->err):
   $CFG->entry->PoSH = $PoSH;
   $CFG->Errors->PoSH = utf2str($Res->err);
   return;
 endif;
// echo "<PRE>"; print_r(curl_getinfo($c)); echo '</PRE>RES=', $Res, '<p><textarea>', htmlspecialchars($z), '</textarea>';  exit;
// if(strlen($Res) and 1!=$Res):
//   $CFG->Error=$Res;
//   return;
// endif;
endif;

/*************************************************
if($a=trim($_POST['alias'])):
 $pl=preg_replace('/\.[^\.]*$/', '.pl', __FILE__);
 exec($pl.' '.base64_encode($a));
endif;
*************************************************/

if($_POST['mail0']) ldap_modify($CFG->AD->h, $CFG->udn, Array('mail'=>Array()));

dupPhoto();

if($_POST['hello']):
  header('Location: ./'.hRef('x', 'mail', 'subject', 'mail'));
else:
  header('Location: ./'.hRef());
endif;

function psEscape($S)
{
 return "'".strtr($S, Array("'"=>"''"))."'";
}

?>
