<?
if(!$_SERVER['HTTPS']) Header('Location: https://ekb.ru'.$_SERVER['REQUEST_URI']);
require('../../lib/uxm.php');
LoadLib('/wizard');
?>
