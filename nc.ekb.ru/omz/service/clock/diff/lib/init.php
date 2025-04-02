<?
header('Content-Type: application/x-javascript');
header('Expires: 0');
?>
var DateDiff=(new Date(<?=
strtr(strftime("%Y, %m-1, %d, %H, %M, %S"), Array(', 0'=>', '))?>, <?=
round(1000*preg_replace('/\s.*/', '', microtime()))?>)).getTime()-(new Date()).getTime();
<? exit; ?>
