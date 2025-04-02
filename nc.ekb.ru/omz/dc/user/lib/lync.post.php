<?
if($PoSH=trim($_POST['PoSH'])):
 $U=psEscape($CFG->AD->Domain."\\".$CFG->u);
 $P=psEscape($_SERVER['PHP_AUTH_PW']);
// Mute error: The EXECUTE permission was denied on the object 'XdsPublishItems', database 'xds', schema 'dbo'
 $PoSHX = " try { $PoSH } catch [System.Data.SqlClient.SqlException] {}";
 $z=<<<WPS
\$cred = New-Object System.Management.Automation.PSCredential($U, (ConvertTo-SecureString $P -AsPlainText -Force))
\$sess = New-PSSession -ComputerName srvsfb-ekbh1.omzglobal.com -Credential \$cred -Authentication CredSSP
Invoke-Command -Session \$sess -ScriptBlock { $PoSHX }
Remove-PSSession \$sess
WPS
;

 set_time_limit(0);

 $c=curl_init('https://ad.ekb.ru/pwsh/');
 curl_setopt($c, CURLOPT_POST, 1);
 curl_setopt($c, CURLOPT_POSTFIELDS, "Command=".urlencode($z));
 curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($c, CURLOPT_CAINFO, "/var/www/net.ekb.ru/ssl/ca.crt");
 curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
 curl_setopt($c, CURLOPT_USERPWD, $CFG->AD->Domain."\\".$CFG->u.':'.$_SERVER['PHP_AUTH_PW']);
 $Res=curl_exec($c);

 $Res = json_decode($Res);

 if ($Res->err):
    echo "<!--\n"; print_r($Res); echo "\n-->\n";
   $CFG->entry->PoSH = $PoSH;
   $CFG->Errors->PoSH = utf2str($Res->err);
   return;
 endif;

//echo "<PRE>$Res\n", "==", $z, "=="; print_r(curl_getinfo($c)); exit;
// if(strlen($Res) and 1!=$Res):
//   $CFG->Error=$Res;
//   return;
// endif;

endif;

header('Location: ./'.hRef());

function psEscape($S)
{
 return "'".strtr($S, Array("'"=>"''"))."'";
}

?>
