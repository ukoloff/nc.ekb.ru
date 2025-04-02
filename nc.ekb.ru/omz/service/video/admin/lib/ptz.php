<?
if(!$CFG->Dispatcher):
 header('HTTP/1.0 403 Forbidden');
 exit;
endif;
$c=getCamera();
if(!$c):
 header('HTTP/1.0 404 Not found');
 exit;
endif;
?>
