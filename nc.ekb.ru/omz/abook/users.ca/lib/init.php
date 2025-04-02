<?
LoadLib('/pfx');

$CFG->title='Сертификаты пользователей';

if($CFG->Auth and isset($_GET['crl'])) LoadLib('crl');
?>
