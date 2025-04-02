<?
$s=preg_match('/[-\w]+/', $_POST['s'], $m)?$m[0]:'';
Header('Content-Type: application/octet-stream');
Header('Content-disposition: attachment; filename="'.$s.'@uxm.rdp"');
?>
full address:s:<?=$s?>

gatewayhostname:s:tsg.ekb.ru
gatewayusagemethod:i:1
gatewaycredentialssource:i:0
gatewayprofileusagemethod:i:1
promptcredentialonce:i:1
enablecredsspsupport:i:0
<? if(strlen(trim($_POST['d']))): ?>
drivestoredirect:s:*
<? endif; ?>
<? if(strlen(trim($_POST['m']))): ?>
audiocapturemode:i:1
<? endif; ?>
<? exit; ?>