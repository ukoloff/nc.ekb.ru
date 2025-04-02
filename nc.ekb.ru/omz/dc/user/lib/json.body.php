<?
doDebug();

 $c=curl_init('https://ad.ekb.ru/pwsh/');
 curl_setopt($c, CURLOPT_POST, 1);
 curl_setopt($c, CURLOPT_POSTFIELDS, "Command=".urlencode("Get-ADUser " . $CFG->params->u . " -Properties * | ConvertTo-Json"));
 curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($c, CURLOPT_CAINFO, "/var/www/net.ekb.ru/ssl/ca.crt");
 curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
 curl_setopt($c, CURLOPT_USERPWD, $CFG->AD->Domain."\\".$CFG->u.':'.$_SERVER['PHP_AUTH_PW']);
// curl_setopt($c, CURLOPT_TIMEOUT, 400);
 $Res=curl_exec($c);

echo utf2str($Res);
// Double-hop issue! :-(
