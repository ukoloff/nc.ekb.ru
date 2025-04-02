<?
LoadLib('/pfx');
$R=pfxCall('pfx1', '', 0);
Header('X-Cookie: '.$R[0]);
Header('X-Location: http://ad.ekb.ru/auth/pfx/?nonce='.urlencode($R[1]));
exit;
?>
