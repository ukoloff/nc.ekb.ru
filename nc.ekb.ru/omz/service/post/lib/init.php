<?
if('POST'!=$_SERVER['REQUEST_METHOD']):
 Header('HTTP/1.0 400 Bad request');
 exit;
endif;

$CFG->checkCSRF='/';
?>
