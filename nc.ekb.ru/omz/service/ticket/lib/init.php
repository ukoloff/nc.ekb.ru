<?
$CFG->AAA=inGroupX('#modifyDIT')?1:2;

$CFG->title='Билетики на Wi-Fi';

if($CFG->Auth) LoadLib('/dc/user/wifi.connect');
?>
